<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // ambil semua data absensi, termasuk relasi student & teacher
        $attendances = Attendance::with(['student', 'teacher'])->latest()->get();

        return view('admin.dashboard', compact('attendances'));
    }
}
