<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Milon\Barcode\DNS1D;
use App\Models\User;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with(['student.class', 'teacher'])->latest()->get();
        return view('admin.dashboard', compact('attendances'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'teacher_id' => 'required|exists:teachers,id',
            'status' => 'required',
        ]);

        Attendance::create([
            'student_id' => $validated['student_id'],
            'teacher_id' => $validated['teacher_id'],
            'date' => now()->toDateString(),
            'time_in' => now()->toTimeString(),
            'status' => $validated['status']
        ]);

        return redirect()->back()->with('success', 'Data absensi berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        Attendance::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data absensi dihapus.');
    }

    // ===================== BARCODE =====================

    public function barcode()
    {
        return view('admin.barcode');
    }

    public function generateBarcode(Request $request)
    {
        $request->validate([
            'option' => 'required|in:1,2',
            'manual_code' => 'nullable|string|min:6|max:9'
        ]);

        if (!file_exists(public_path('barcodes'))) {
    mkdir(public_path('barcodes'), 0755, true);
}


        if ($request->option == 1) {
            $base = substr($request->manual_code, 0, 6);
            $random = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
            $code = $base . $random;
        } else {
            $code = $request->manual_code;
        }

        $barcode = new DNS1D();
        $barcode->setStorPath(public_path('barcodes/'));
        $fileName = $code . '.png';
        file_put_contents(public_path('barcodes/'.$fileName), base64_decode($barcode->getBarcodePNG($code, 'C39')));

        return response()->download(public_path('barcodes/'.$fileName));
    }

    // ===================== SCAN =====================

    public function scan()
    {
        return view('admin.scan');
    }

    public function validateScan(Request $request)
    {
        $student = Student::where('nipd', $request->nipd)->first();

        if (!$student) {
            return response()->json(['success' => false, 'message' => 'NIPD tidak ditemukan']);
        }
        

        Attendance::create([
            'student_id' => $student->id,
            'teacher_id' => auth()->user()->teacher_id ?? 1,
            'date' => now()->toDateString(),
            'time_in' => now()->toTimeString(),
            'status' => 'hadir',
        ]);

        if (Attendance::whereDate('date', now())->where('student_id', $student->id)->exists()) {
    return response()->json(['success' => false, 'message' => 'Siswa sudah absen hari ini!']);
}


        return response()->json(['success' => true, 'message' => 'Absensi berhasil!']);
    }
}
