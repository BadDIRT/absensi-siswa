<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function scanForm()
    {
        if(auth()->user()->role === 'admin')
        return view('admin.attendances.scan');
        elseif(auth()->user()->role === 'teacher')
        return view('teacher.attendances.scan');
        else
        return view('student.attendances.scan');
    }

    public function scanProcess(Request $request)
    {
        $request->validate([
            'nipd' => 'required'
        ]);

        $student = Student::where('nipd', $request->nipd)->first();

        if (!$student) {
            return back()->with('error', 'NIPD tidak terdaftar.');
        }

        $today = Carbon::today();

        $attendance = Attendance::where('student_id', $student->id)
            ->whereDate('date', $today)
            ->first();

        // === SCAN PERTAMA (MASUK) ===
        if (!$attendance) {
            Attendance::create([
                'student_id' => $student->id,
                'teacher_id' => auth()->user()->teacher->id ?? 1,
                'date'       => $today,
                'time_in'    => Carbon::now()->format('H:i:s'),
                'status'     => 'hadir',
            ]);

            return back()->with('success', 'Absensi masuk berhasil.');
        }

        // === SCAN KEDUA (PULANG) ===
        if ($attendance->time_in && !$attendance->time_out) {
            $attendance->update([
                'time_out' => Carbon::now()->format('H:i:s'),
            ]);

            return back()->with('success', 'Absensi pulang berhasil.');
        }

        // === SCAN KETIGA (DITOLAK) ===
        return back()->with('error', 'Absensi hari ini sudah lengkap.');
    }
}
