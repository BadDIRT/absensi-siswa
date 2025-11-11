<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Department;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class StudentCrudController extends Controller
{
    /**
     * Tampilkan daftar semua siswa.
     */
    public function index()
    {
        $students = Student::with(['class', 'department'])->latest()->get();
        return view('admin.students.index', compact('students'));
    }

    /**
     * Tampilkan form tambah siswa.
     */
    public function create()
    {
        $classes = SchoolClass::all();
        $departments = Department::all();
        return view('admin.students.create', compact('classes', 'departments'));
    }

    /**
     * Simpan data siswa baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'date_of_birth' => 'required|date',
            'nisn' => 'required|numeric|unique:students,nisn',
            'nipd' => 'required|numeric|unique:students,nipd',
            'class_id' => 'required|exists:classes,id',
            'department_id' => 'required|exists:departments,id',
        ]);

        Student::create($validated);

        return redirect()->route('admin.students.index')
            ->with('success', 'Data siswa berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail siswa.
     */
    public function show(Student $student)
    {
        $student->load(['class', 'department']);
        return view('admin.students.show', compact('student'));
    }

    /**
     * Tampilkan form edit siswa.
     */
    public function edit(Student $student)
    {
        $classes = SchoolClass::all();
        $departments = Department::all();
        return view('admin.students.edit', compact('student', 'classes', 'departments'));
    }

    /**
     * Update data siswa.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'date_of_birth' => 'required|date',
            'nisn' => 'required|numeric|unique:students,nisn,' . $student->id,
            'nipd' => 'required|numeric|unique:students,nipd,' . $student->id,
            'class_id' => 'required|exists:classes,id',
            'department_id' => 'required|exists:departments,id',
        ]);

        $student->update($validated);

        return redirect()->route('admin.students.index')
            ->with('success', 'Data siswa berhasil diperbarui!');
    }

    /**
     * Hapus data siswa.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('admin.students.index')
            ->with('success', 'Data siswa berhasil dihapus!');
    }
}
