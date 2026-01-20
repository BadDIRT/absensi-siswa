<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Attendance;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // STATUS ABSENSI HARI INI (PASTI LENGKAP)
        $rawStatus = Attendance::whereDate('date', $today)
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $statusStats = [
            'hadir' => $rawStatus['hadir'] ?? 0,
            'izin'  => $rawStatus['izin'] ?? 0,
            'sakit' => $rawStatus['sakit'] ?? 0,
            'tidak hadir' => $rawStatus['tidak hadir'] ?? 0,
        ];

       // ABSENSI 7 HARI TERAKHIR (HANYA HADIR)
$weeklyAttendance = Attendance::select(
        DB::raw('DATE(date) as date'),
        DB::raw('count(*) as total')
    )
    ->where('status', 'hadir')
    ->whereBetween('date', [
        Carbon::now()->subDays(6)->startOfDay(),
        Carbon::now()->endOfDay()
    ])
    ->groupBy(DB::raw('DATE(date)'))
    ->orderBy('date')
    ->get();

return view('teacher.dashboard', [
    'totalStudents'     => Student::count(),
    'totalTeachers'     => Teacher::count(),
    'totalDepartments'  => Department::count(),
    'presentToday'      => $statusStats['hadir'] ?? 0,
    'statusStats'       => $statusStats,
    'weeklyAttendance'  => $weeklyAttendance,
]);
}
}
