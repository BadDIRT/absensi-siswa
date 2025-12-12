<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentCrudController extends Controller
{
    /**
     * Tampilkan daftar semua jurusan.
     */
    public function index(Request $request)
    {
        $query = Department::query();

        // SEARCH (pencarian umum)
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('code', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // FILTER BERDASARKAN FIELD
        if ($request->filter_field && $request->filter_value) {
            if ($request->filter_field === 'name') {
                $query->where('name', 'like', '%' . $request->filter_value . '%');
            } elseif ($request->filter_field === 'code') {
                $query->where('code', 'like', '%' . $request->filter_value . '%');
            } elseif ($request->filter_field === 'description') {
                $query->where('description', 'like', '%' . $request->filter_value . '%');
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
        $departments = $query->paginate(10)->withQueryString();

        return view('admin.departments.index', compact('departments'));
    }

    /**
     * Tampilkan form tambah jurusan.
     */
    public function create()
    {
        return view('admin.departments.create');
    }

    /**
     * Simpan data jurusan baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:departments,name',
            'code'        => 'nullable|string|max:50|unique:departments,code',
            'description' => 'nullable|string|max:500',
        ], [
            'name.required' => 'Nama jurusan wajib diisi.',
            'name.unique'   => 'Nama jurusan sudah terdaftar.',
            'code.unique'   => 'Kode jurusan sudah digunakan.',
            'description.max' => 'Deskripsi maksimal 500 karakter.',
        ]);

        Department::create($validated);

        return redirect()->route('departments.index')
            ->with('success', 'Data jurusan berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail jurusan.
     */
    public function show(Department $department)
    {
        $department->load(['classes', 'students']);
        return view('admin.departments.show', compact('department'));
    }

    /**
     * Tampilkan form edit jurusan.
     */
    public function edit(Department $department)
    {
        return view('admin.departments.edit', compact('department'));
    }

    /**
     * Update data jurusan.
     */
    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:departments,name,' . $department->id,
            'code'        => 'nullable|string|max:50|unique:departments,code,' . $department->id,
            'description' => 'nullable|string|max:500',
        ], [
            'name.required' => 'Nama jurusan wajib diisi.',
            'name.unique'   => 'Nama jurusan sudah terdaftar.',
            'code.unique'   => 'Kode jurusan sudah digunakan.',
        ]);

        $department->update($validated);

        return redirect()->route('departments.index')
            ->with('success', 'Data jurusan berhasil diperbarui!');
    }

    /**
     * Hapus data jurusan.
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index')
            ->with('success', 'Data jurusan berhasil dihapus!');
    }
}
