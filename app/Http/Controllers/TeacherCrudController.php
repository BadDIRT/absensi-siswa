<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherCrudController extends Controller
{
    /**
     * Tampilkan daftar semua guru.
     */
    public function index()
    {
        $teachers = Teacher::latest()->get();
        return view('admin.teachers.index', compact('teachers'));
    }

    /**
     * Tampilkan form tambah guru.
     */
    public function create()
    {
        return view('admin.teachers.create');
    }

    /**
     * Simpan data guru baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'nip'           => 'nullable|string|max:50|unique:teachers,nip',
            'gender'        => 'nullable|in:L,P',
            'phone_number'  => 'nullable|string|max:20',
        ], [
            'name.required' => 'Nama guru wajib diisi.',
            'nip.unique'    => 'NIP sudah terdaftar.',
            'gender.in'     => 'Jenis kelamin harus L (Laki-laki) atau P (Perempuan).',
            'phone_number.string' => 'Nomor telepon harus berupa teks.',
            'phone_number.max' => 'Nomor telepon maksimal 20 karakter.',
        ]);

        Teacher::create($validated);

        return redirect()->route('teachers.index')
            ->with('success', 'Data guru berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail guru.
     */
    public function show(Teacher $teacher)
    {
        $teacher->load('classes');
        return view('admin.teachers.show', compact('teacher'));
    }

    /**
     * Tampilkan form edit guru.
     */
    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    /**
     * Update data guru.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'nip'           => 'nullable|string|max:50|unique:teachers,nip,' . $teacher->id,
            'gender'        => 'nullable|in:L,P',
            'phone_number'  => 'nullable|string|max:20',
        ], [
            'name.required' => 'Nama guru wajib diisi.',
            'nip.unique'    => 'NIP sudah terdaftar.',
            'gender.in'     => 'Jenis kelamin harus L (Laki-laki) atau P (Perempuan).',
        ]);

        $teacher->update($validated);

        return redirect()->route('teachers.index')
            ->with('success', 'Data guru berhasil diperbarui!');
    }

    /**
     * Hapus data guru.
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()->route('teachers.index')
            ->with('success', 'Data guru berhasil dihapus!');
    }
}
