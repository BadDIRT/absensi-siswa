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
    public function index(Request $request)
    {
        $query = Student::with(['class', 'department']);

        // SEARCH (pencarian umum)
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('nisn', 'like', '%' . $request->search . '%')
                  ->orWhere('nipd', 'like', '%' . $request->search . '%')
                  ->orWhere('gender', 'like', '%' . $request->search . '%')
                  ->orWhereHas('class', function ($c) use ($request) {
                      $c->where('grade', 'like', '%' . $request->search . '%');
                  })
                  ->orWhereHas('department', function ($d) use ($request) {
                      $d->where('name', 'like', '%' . $request->search . '%');
                  });
            });
        }

        // FILTER BERDASARKAN FIELD
        if ($request->filter_field && $request->filter_value) {
            if ($request->filter_field === 'class') {
                $query->whereHas('class', function ($c) use ($request) {
                    $c->where('grade', 'like', '%' . $request->filter_value . '%');
                });
            } elseif ($request->filter_field === 'department') {
                $query->whereHas('department', function ($d) use ($request) {
                    $d->where('name', 'like', '%' . $request->filter_value . '%');
                });
            } elseif ($request->filter_field === 'gender') {
                $query->where('gender', $request->filter_value);
            } else {
                $query->where($request->filter_field, 'like', '%' . $request->filter_value . '%');
            }
        }

        // SORTING
        if ($request->sort_order == 'latest') {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->sort_order == 'oldest') {
            $query->orderBy('created_at', 'asc');
        }

        // PAGINATION
        $students = $query->paginate(10)->withQueryString();

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
            'name'           => 'required|string|max:255',
            'gender'         => 'required|in:L,P',
            'date_of_birth'  => 'required|date',
            'nisn'           => 'required|numeric|unique:students,nisn',
            'nipd'           => 'required|numeric|unique:students,nipd',
            'class_id'       => 'required|exists:classes,id',
            'department_id'  => 'required|exists:departments,id',
            'address'        => 'nullable|string|max:500',
        ], [
            'name.required'          => 'Nama siswa wajib diisi.',
            'gender.required'        => 'Jenis kelamin wajib dipilih.',
            'gender.in'              => 'Jenis kelamin harus L atau P.',
            'date_of_birth.required' => 'Tanggal lahir wajib diisi.',
            'date_of_birth.date'     => 'Tanggal lahir tidak valid.',
            'nisn.required'          => 'NISN wajib diisi.',
            'nisn.unique'            => 'NISN sudah terdaftar.',
            'nipd.required'          => 'NIPD wajib diisi.',
            'nipd.unique'            => 'NIPD sudah terdaftar.',
            'class_id.required'      => 'Kelas wajib dipilih.',
            'class_id.exists'        => 'Kelas yang dipilih tidak valid.',
            'department_id.required' => 'Jurusan wajib dipilih.',
            'department_id.exists'   => 'Jurusan yang dipilih tidak valid.',
            'address.max'            => 'Alamat maksimal 500 karakter.',
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
            'name'           => 'required|string|max:255',
            'gender'         => 'required|in:L,P',
            'date_of_birth'  => 'required|date',
            'nisn'           => 'required|numeric|unique:students,nisn,' . $student->id,
            'nipd'           => 'required|numeric|unique:students,nipd,' . $student->id,
            'class_id'       => 'required|exists:classes,id',
            'department_id'  => 'required|exists:departments,id',
            'address'        => 'nullable|string|max:500',
        ], [
            'name.required'          => 'Nama siswa wajib diisi.',
            'gender.required'        => 'Jenis kelamin wajib dipilih.',
            'gender.in'              => 'Jenis kelamin harus L atau P.',
            'date_of_birth.required' => 'Tanggal lahir wajib diisi.',
            'date_of_birth.date'     => 'Tanggal lahir tidak valid.',
            'nisn.required'          => 'NISN wajib diisi.',
            'nisn.unique'            => 'NISN sudah terdaftar.',
            'nipd.required'          => 'NIPD wajib diisi.',
            'nipd.unique'            => 'NIPD sudah terdaftar.',
            'class_id.required'      => 'Kelas wajib dipilih.',
            'class_id.exists'        => 'Kelas yang dipilih tidak valid.',
            'department_id.required' => 'Jurusan wajib dipilih.',
            'department_id.exists'   => 'Jurusan yang dipilih tidak valid.',
            'address.max'            => 'Alamat maksimal 500 karakter.',
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
