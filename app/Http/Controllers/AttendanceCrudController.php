<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceCrudController extends Controller
{
    /**
     * Tampilkan daftar absensi.
     */
    public function index(Request $request)
    {
        $query = Attendance::with(['student', 'teacher']);

        // SEARCH (nama siswa / guru / status / tanggal)
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('status', 'like', '%' . $request->search . '%')
                  ->orWhereDate('date', $request->search)
                  ->orWhereHas('student', function ($s) use ($request) {
                      $s->where('name', 'like', '%' . $request->search . '%');
                  })
                  ->orWhereHas('teacher', function ($t) use ($request) {
                      $t->where('name', 'like', '%' . $request->search . '%');
                  });
            });
        }

        // FILTER
        if ($request->filter_field && $request->filter_value) {
            if ($request->filter_field === 'student') {
                $query->whereHas('student', function ($s) use ($request) {
                    $s->where('name', 'like', '%' . $request->filter_value . '%');
                });
            } elseif ($request->filter_field === 'teacher') {
                $query->whereHas('teacher', function ($t) use ($request) {
                    $t->where('name', 'like', '%' . $request->filter_value . '%');
                });
            } elseif ($request->filter_field === 'status') {
                $query->where('status', $request->filter_value);
            } elseif ($request->filter_field === 'date') {
                $query->whereDate('date', $request->filter_value);
            }
        }

        // SORTING
        if ($request->sort_order === 'latest') {
            $query->orderBy('date', 'desc');
        }

        if ($request->sort_order === 'oldest') {
            $query->orderBy('date', 'asc');
        }

        // PAGINATION
        $attendances = $query->paginate(10)->withQueryString();

        $user = Auth::user();

    // Pastikan user memiliki kolom 'role' atau relasi ke role
    if ($user->role == 'admin') {
        return view('admin.attendances.index', compact('attendances'));
    } elseif ($user->role == 'teacher') {
        return view('teacher.attendances.index', compact('attendances'));
    } else {
        return view('student.attendances.index', compact('attendances'));
    }
    }

    /**
     * Tampilkan form tambah absensi.
     */
    public function create()
    {
        $students = Student::orderBy('name')->get();
        $teachers = Teacher::orderBy('name')->get();

        return view('admin.attendances.create', compact('students', 'teachers'));
    }

    /**
     * Simpan data absensi baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'teacher_id' => 'required|exists:teachers,id',
            'date'       => 'required|date',
            'status'     => 'required|in:hadir,sakit,izin,tidak hadir',
            'time_in' => 'nullable|required_if:status,hadir',
            'time_out' => 'nullable|required_if:status,hadir',
        ], [
            'student_id.required' => 'Siswa wajib dipilih.',
            'student_id.exists'   => 'Siswa tidak valid.',
            'teacher_id.required' => 'Guru wajib dipilih.',
            'teacher_id.exists'   => 'Guru tidak valid.',
            'date.required'       => 'Tanggal absensi wajib diisi.',
            'date.date'           => 'Format tanggal tidak valid.',
            'status.required'     => 'Status absensi wajib dipilih.',
            'status.in'           => 'Status absensi tidak valid.',
        ]);

        // Cegah absensi ganda
        $exists = Attendance::where('student_id', $validated['student_id'])
            ->whereDate('date', $validated['date'])
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->with('error', 'Siswa sudah melakukan absensi pada tanggal tersebut.');
        }

        Attendance::create($validated);

        return redirect()
            ->route('admin.attendances.index')
            ->with('success', 'Data absensi berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail absensi.
     */
    public function show(Attendance $attendance)
    {
        $attendance->load(['student', 'teacher']);

        return view('admin.attendances.show', compact('attendance'));
    }

    /**
     * Tampilkan form edit absensi.
     */
    public function edit(Attendance $attendance)
    {
        $students = Student::orderBy('name')->get();
        $teachers = Teacher::orderBy('name')->get();

        return view('admin.attendances.edit', compact('attendance', 'students', 'teachers'));
    }

    /**
     * Update data absensi.
     */
    public function update(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'teacher_id' => 'required|exists:teachers,id',
            'date'       => 'required|date',
            'status'     => 'required|in:hadir,sakit,izin,tidak hadir',
            'time_in' => 'nullable|required_if:status,hadir',
            'time_out' => 'nullable|required_if:status,hadir',
        ], [
            'student_id.required' => 'Siswa wajib dipilih.',
            'teacher_id.required' => 'Guru wajib dipilih.',
            'date.required'       => 'Tanggal absensi wajib diisi.',
            'status.required'     => 'Status absensi wajib dipilih.',
            'status.in'           => 'Status absensi tidak valid.',
            'date.date'           => 'Format tanggal tidak valid.',
            'student_id.exists'   => 'Siswa tidak valid.',
            'teacher_id.exists'   => 'Guru tidak valid.',
        ]);

        $attendance->update($validated);

        return redirect()
            ->route('admin.attendances.index')
            ->with('success', 'Data absensi berhasil diperbarui!');
    }

    /**
     * Hapus data absensi.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()
            ->route('admin.attendances.index')
            ->with('success', 'Data absensi berhasil dihapus!');
    }
}
