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

    $path = public_path('storage/barcodes/');

    // WAJIB: pastikan folder ada
    if (!file_exists($path)) {
        mkdir($path, 0755, true);
    }

    $barcode->setStorPath($path);

    $fileName = $barcode->getBarcodePNGPath(
        (string) $student->nipd, // CAST STRING (PENTING)
        'C128',
        3,
        60
    );

    // 🔥 INI KUNCI DEBUG
    if (!$fileName) {
        return back()->with('error', 'Gagal generate barcode (PNG tidak terbentuk).');
    }

    $student->update([
        'barcode' => 'barcodes/'.$fileName,
    ]);

    return redirect()
        ->route('students.index')
        ->with('success', 'Kode batang berhasil dibuat.');
    }

    public function download(Student $student)
    {
        if (!$student->barcode || !Storage::disk('public')->exists($student->barcode)) {
            abort(404);
        }

        return Storage::disk('public')->download(
            $student->barcode,
            'barcode-'.$student->nipd.'.png'
        );
    }
}
