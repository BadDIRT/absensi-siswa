<?php

namespace App\Http\Controllers;

use App\Models\Timetable;
use App\Models\SchoolClass;
use App\Models\Teacher;
use App\Models\Subject;
use Illuminate\Http\Request;

class TimetableCrudController extends Controller
{
    /**
     * Tampilkan daftar semua jadwal.
     */
    public function index(Request $request)
    {
        $query = Timetable::with(['teacher', 'class']);

    // SEARCH (pencarian umum)
    if ($request->search) {
        $query->where(function($q) use ($request) {
            $q->where('day', 'like', '%' . $request->search . '%')
              ->orWhere('start_time', 'like', '%' . $request->search . '%')
              ->orWhere('end_time', 'like', '%' . $request->search . '%')
              ->orWhereHas('teacher', function($t) use ($request) {
                  $t->where('name', 'like', '%' . $request->search . '%');
              })
              ->orWhereHas('class', function($c) use ($request) {
                  $c->where('grade', 'like', '%' . $request->search . '%');
              });
        });
    }

    // FILTER BERDASARKAN FIELD
    if ($request->filter_field && $request->filter_value) {
        if ($request->filter_field === 'teacher') {
            $query->whereHas('teacher', function($t) use ($request) {
                $t->where('name', 'like', '%' . $request->filter_value . '%');
            });
        } elseif ($request->filter_field === 'class') {
            $query->whereHas('class', function($c) use ($request) {
                $c->where('grade', 'like', '%' . $request->filter_value . '%');
            });
        } else {
            $query->where($request->filter_field, 'like', '%' . $request->filter_value . '%');
        }
    }

    if ($request->sort_order == 'latest') {
        $query->orderBy('created_at', 'desc');
    }

    if ($request->sort_order == 'oldest') {
        $query->orderBy('created_at', 'asc');
    }


    // PAGINATION 20 DATA
    $timetables = $query->paginate(10)->withQueryString();

    return view('admin.timetables.index', compact('timetables'));
    }

    /**
     * Tampilkan form tambah jadwal.
     */
    public function create()
    {
        $classes = SchoolClass::all();
        $teachers = Teacher::all();
        $subjects = Subject::all();

        return view('admin.timetables.create', compact('classes', 'teachers', 'subjects'));
    }

    /**
     * Simpan data jadwal baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
            'day' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ], [
            'class_id.required' => 'Kelas wajib dipilih.',
            'teacher_id.required' => 'Guru wajib dipilih.',
            'subject_id.required' => 'Mata pelajaran wajib dipilih.',
            'day.required' => 'Hari wajib dipilih.',
            'start_time.required' => 'Jam mulai wajib diisi.',
            'end_time.required' => 'Jam selesai wajib diisi.',
            'end_time.after' => 'Jam selesai harus setelah jam mulai.',
            'day.in' => 'Hari harus salah satu dari: Senin, Selasa, Rabu, Kamis, Jumat.',
            'start_time.date_format' => 'Format jam mulai tidak valid. Gunakan format HH:MM.',
            'end_time.date_format' => 'Format jam selesai tidak valid. Gunakan format HH:MM.',
            'class_id.exists' => 'Kelas yang dipilih tidak valid.',
            'teacher_id.exists' => 'Guru yang dipilih tidak valid.',
            'subject_id.exists' => 'Mata pelajaran yang dipilih tidak valid.',
        ]);

        Timetable::create($validated);

        return redirect()->route('timetables.index')
            ->with('success', 'Data jadwal berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail jadwal.
     */
    public function show(Timetable $timetable)
    {
        $timetable->load(['class', 'teacher', 'subject']);
        return view('admin.timetables.show', compact('timetable'));
    }

    /**
     * Tampilkan form edit jadwal.
     */
    public function edit(Timetable $timetable)
    {
        $classes = SchoolClass::all();
        $teachers = Teacher::all();
        $subjects = Subject::all();

        return view('admin.timetables.edit', compact('timetable', 'classes', 'teachers', 'subjects'));
    }

    /**
     * Update data jadwal.
     */
    public function update(Request $request, Timetable $timetable)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
            'day' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ], [
            'class_id.required' => 'Kelas wajib dipilih.',
            'teacher_id.required' => 'Guru wajib dipilih.',
            'subject_id.required' => 'Mata pelajaran wajib dipilih.',
            'day.required' => 'Hari wajib dipilih.',
            'start_time.required' => 'Jam mulai wajib diisi.',
            'end_time.required' => 'Jam selesai wajib diisi.',
            'end_time.after' => 'Jam selesai harus setelah jam mulai.',
            'day.in' => 'Hari harus salah satu dari: Senin, Selasa, Rabu, Kamis, Jumat.',
            'start_time.date_format' => 'Format jam mulai tidak valid. Gunakan format HH:MM.',
            'end_time.date_format' => 'Format jam selesai tidak valid. Gunakan format HH:MM.',
            'class_id.exists' => 'Kelas yang dipilih tidak valid.',
            'teacher_id.exists' => 'Guru yang dipilih tidak valid.',
            'subject_id.exists' => 'Mata pelajaran yang dipilih tidak valid',
        ]);

        $timetable->update($validated);

        return redirect()->route('timetables.index')
            ->with('success', 'Data jadwal berhasil diperbarui!');
    }

    /**
     * Hapus data jadwal.
     */
    public function destroy(Timetable $timetable)
    {
        $timetable->delete();

        return redirect()->route('timetables.index')
            ->with('success', 'Data jadwal berhasil dihapus!');
    }
}
