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
            'address' => 'nullable|string|max:500',
        ], [
            // Custom error messages (opsional)
            'name.required' => 'Nama siswa wajib diisi.',
            'gender.required' => 'Jenis kelamin wajib dipilih.',
            'date_of_birth.required' => 'Tanggal lahir wajib diisi.',
            'nisn.required' => 'NISN wajib diisi.',
            'nipd.required' => 'NIPD wajib diisi.',
            'class_id.required' => 'Kelas wajib dipilih.',
            'department_id.required' => 'Jurusan wajib dipilih.',
            'address.string' => 'Alamat harus berupa teks.',
            'address.max' => 'Alamat maksimal 500 karakter.',
            'nisn.unique' => 'NISN sudah terdaftar.',
            'nipd.unique' => 'NIPD sudah terdaftar.',
            'gender.in' => 'Jenis kelamin harus L atau P.',
            'date_of_birth.date' => 'Tanggal lahir tidak valid.',
            'class_id.exists' => 'Kelas yang dipilih tidak valid.',
            'department_id.exists' => 'Jurusan yang dipilih tidak valid.',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')
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
            'address' => 'nullable|string|max:500',
        ], [
            'name.required' => 'Nama siswa wajib diisi.',
            'gender.required' => 'Jenis kelamin wajib dipilih.',
            'date_of_birth.required' => 'Tanggal lahir wajib diisi.',
            'nisn.required' => 'NISN wajib diisi.',
            'nipd.required' => 'NIPD wajib diisi.',
            'class_id.required' => 'Kelas wajib dipilih.',
            'department_id.required' => 'Jurusan wajib dipilih.',
            'address.string' => 'Alamat harus berupa teks.',
            'address.max' => 'Alamat maksimal 500 karakter.',
            'nisn.unique' => 'NISN sudah terdaftar.',
            'nipd.unique' => 'NIPD sudah terdaftar.',
            'gender.in' => 'Jenis kelamin harus L atau P.',
            'date_of_birth.date' => 'Tanggal lahir tidak valid.',
            'class_id.exists' => 'Kelas yang dipilih tidak valid.',
            'department_id.exists' => 'Jurusan yang dipilih tidak valid.',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')
            ->with('success', 'Data siswa berhasil diperbarui!');
    }

    /**
     * Hapus data siswa.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Data siswa berhasil dihapus!');
    }
}
