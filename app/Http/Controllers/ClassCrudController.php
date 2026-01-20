<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Department;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassCrudController extends Controller
{
    /**
     * Tampilkan daftar semua kelas.
     */
    public function index(Request $request)
    {
        $query = SchoolClass::with(['department', 'teacher']);

        // ================= SEARCH (pencarian umum) =================
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('grade', 'like', '%' . $request->search . '%')
                  ->orWhereHas('department', function ($d) use ($request) {
                      $d->where('name', 'like', '%' . $request->search . '%');
                  })
                  ->orWhereHas('teacher', function ($t) use ($request) {
                      $t->where('name', 'like', '%' . $request->search . '%');
                  });
            });
        }

        // ================= FILTER BERDASARKAN FIELD =================
        if ($request->filter_field && $request->filter_value) {
            if ($request->filter_field === 'department') {
                $query->whereHas('department', function ($d) use ($request) {
                    $d->where('name', 'like', '%' . $request->filter_value . '%');
                });
            } elseif ($request->filter_field === 'teacher') {
                $query->whereHas('teacher', function ($t) use ($request) {
                    $t->where('name', 'like', '%' . $request->filter_value . '%');
                });
            } else {
                $query->where($request->filter_field, 'like', '%' . $request->filter_value . '%');
            }
        }

        // ================= SORTING =================
        if ($request->sort_order === 'latest') {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->sort_order === 'oldest') {
            $query->orderBy('created_at', 'asc');
        }

        // ================= PAGINATION =================
        $classes = $query->paginate(10)->withQueryString();

        return view('admin.classes.index', compact('classes'));
    }

    /**
     * Tampilkan form tambah kelas.
     */
    public function create()
    {
        $departments = Department::orderBy('name')->get();
        $teachers = Teacher::orderBy('name')->get();

        return view('admin.classes.create', compact('departments', 'teachers'));
    }

    /**
     * Simpan data kelas baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'grade'         => 'required|integer|in:10,11,12',
            'teacher_id'    => 'nullable|exists:teachers,id',
        ], [
            'department_id.required' => 'Jurusan wajib dipilih.',
            'department_id.exists'   => 'Jurusan tidak valid.',
            'grade.required'         => 'Tingkat kelas wajib diisi.',
            'grade.in'               => 'Tingkat kelas hanya boleh 10, 11, atau 12.',
            'teacher_id.exists'      => 'Guru tidak valid.',
        ]);

        SchoolClass::create($validated);

        return redirect()->route('admin.classes.index')
            ->with('success', 'Data kelas berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail kelas.
     */
    public function show(SchoolClass $class)
    {
        $class->load(['department', 'teacher', 'students']);
        return view('admin.classes.show', compact('class'));
    }

    /**
     * Tampilkan form edit kelas.
     */
    public function edit(SchoolClass $class)
    {
        $departments = Department::orderBy('name')->get();
        $teachers = Teacher::orderBy('name')->get();

        return view('admin.classes.edit', compact('class', 'departments', 'teachers'));
    }

    /**
     * Update data kelas.
     */
    public function update(Request $request, SchoolClass $class)
    {
        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'grade'         => 'required|integer|in:10,11,12',
            'teacher_id'    => 'nullable|exists:teachers,id',
        ], [
            'department_id.required' => 'Jurusan wajib dipilih.',
            'department_id.exists'   => 'Jurusan tidak valid.',
            'grade.required'         => 'Tingkat kelas wajib diisi.',
            'grade.in'               => 'Tingkat kelas hanya boleh 10, 11, atau 12.',
            'teacher_id.exists'      => 'Guru tidak valid.',
        ]);

        $class->update($validated);

        return redirect()->route('admin.classes.index')
            ->with('success', 'Data kelas berhasil diperbarui!');
    }

    /**
     * Hapus data kelas.
     */
    public function destroy(SchoolClass $class)
    {
        $class->delete();

        return redirect()->route('admin.classes.index')
            ->with('success', 'Data kelas berhasil dihapus!');
    }
}
