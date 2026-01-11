<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\DNS1D;

class BarcodeController extends Controller
{
    public function create()
    {
        return view('admin.students.createBarcode');
    }

    public function store(Request $request)
{
    $request->validate([
        'nipd' => 'required|exists:students,nipd',
    ]);

    $student = Student::where('nipd', $request->nipd)->first();

    if ($student->barcode) {
        return back()->with('error', 'Siswa ini sudah memiliki kode batang.');
    }

    $barcode = new DNS1D();

    // PATH PUBLIC (BUKAN STORAGE)
    $path = public_path('barcodes/');

    // Pastikan folder ada
    if (!file_exists($path)) {
        mkdir($path, 0755, true);
    }

    // Set lokasi simpan
    $barcode->setStorPath($path);

    // Generate PNG (isi = NIPD)
    $fileName = $barcode->getBarcodePNGPath(
        (string) $student->nipd,
        'C128',
        3,
        60
    );

    if (!$fileName) {
        return back()->with('error', 'Gagal generate barcode.');
    }

    // SIMPAN PATH RELATIF KE DB
    $student->update([
        'barcode' => $fileName,
    ]);

    return redirect()
        ->route('students.index')
        ->with('success', 'Kode batang berhasil dibuat.');
}


    public function download(Student $student)
{
    abort_if(!$student->nipd, 404, 'Data siswa tidak valid.');

    // 1. Buat object DNS1D
    $dns1d = new DNS1D();

    // (opsional tapi aman)
    $dns1d->setStorPath(storage_path('app'));

    // 2. Generate barcode BASE64
    $barcodeBase64 = $dns1d->getBarcodePNG(
        (string) $student->nipd,
        'C128',
        3,
        60
    );

    abort_if(!$barcodeBase64, 500, 'Gagal generate barcode.');

    // 3. Decode ke binary PNG
    $barcodeBinary = base64_decode($barcodeBase64);

    // 4. Simpan ke file sementara
    $tempPath = storage_path('app/temp-barcode-'.$student->nipd.'.png');
    file_put_contents($tempPath, $barcodeBinary);

    // 5. Download & hapus setelah terkirim
    return response()->download(
        $tempPath,
        "barcode-{$student->nipd}.png"
    )->deleteFileAfterSend(true);
}


}
