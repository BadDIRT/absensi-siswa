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
    public function index()
    {
        $timetables = Timetable::with(['class', 'teacher', 'subject'])
            ->orderBy('day')
            ->orderBy('start_time')
            ->get();

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
