<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Classes;
use App\Models\Department;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\DNS1D;
use Carbon\Carbon;

class BarcodeController extends Controller
{
    public function index()
    {
        $classes = SchoolClass::all();
        $departments = Department::all();
        return view('admin.barcode', compact('classes', 'departments'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'option' => 'required|in:1,2',
            'manual_code' => 'nullable|string|max:9',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'date_of_birth' => 'required|date',
            'class_id' => 'required|exists:classes,id',
            'department_id' => 'required|exists:departments,id',
        ]);

        // Generate NIPD (barcode number)
        if ($request->option == 1) {
            $prefix = substr($request->manual_code, 0, 6);
            if (strlen($prefix) !== 6) {
                return back()->with('error', 'Isi 6 digit pertama untuk opsi ini.');
            }
            $random = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
            $nipd = $prefix . $random;
        } else {
            if (strlen($request->manual_code) !== 9) {
                return back()->with('error', 'Kode manual harus 9 digit.');
            }
            $nipd = $request->manual_code;
        }

        // Generate barcode image
        $barcode = new DNS1D();
        $barcode->setStorPath(public_path('storage/barcodes/'));

        if (!Storage::exists('public/barcodes')) {
            Storage::makeDirectory('public/barcodes');
        }

        $fileName = $nipd . '.png';
        $filePath = 'public/barcodes/' . $fileName;
        $pngData = base64_decode($barcode->getBarcodePNG($nipd, 'C128'));
        Storage::put($filePath, $pngData);

        // Simpan ke tabel students
        $student = Student::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'class_id' => $request->class_id,
            'department_id' => $request->department_id,
            'nipd' => $nipd,
            'barcode' => $nipd, // disamakan dengan nama file barcode
        ]);

        return back()->with('success', 'Barcode & data siswa berhasil dibuat!')
                     ->with('barcode_file', $fileName)
                     ->with('barcode_code', $nipd)
                     ->with('student_name', $student->name);
    }
}
