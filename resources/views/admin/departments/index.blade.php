@extends('layouts.indexMain')

@section('headerTitle', 'ABSENSIKU - Data Jurusan')
@section('pageTitle', 'Data Jurusan')
@section('routeCreate', route('admin.departments.create'))
@section('createButtonText', '+ Tambah Jurusan')

{{-- SEARCH + FILTER --}}
@section('searching')
    <option value="name" class="text-black" {{ request('filter_field') == 'name' ? 'selected' : '' }}>Nama Jurusan</option>
    <option value="code" class="text-black" {{ request('filter_field') == 'code' ? 'selected' : '' }}>Kode</option>
    <option value="description" class="text-black" {{ request('filter_field') == 'description' ? 'selected' : '' }}>Deskripsi</option>
@endsection

@section('title', 'Daftar Jurusan')

{{-- TABEL HEAD DESKTOP --}}
@section('thead')
    <th class="p-3">No</th>
    <th class="p-3">Nama Jurusan</th>
    <th class="p-3">Kode</th>
    <th class="p-3">Deskripsi</th>
    <th class="p-3 text-center">Aksi</th>
@endsection

{{-- TABEL DESKTOP ROWS --}}
@section('tableRowsData')
    @forelse($departments as $d)
        <tr class="border-b border-white/10 hover:bg-white/10 transition-all duration-300">
            <td class="p-3">{{ $loop->iteration }}</td>
            <td class="p-3 font-semibold">{{ $d->name }}</td>
            <td class="p-3">{{ $d->code ?? '-' }}</td>
            <td class="p-3">{{ $d->description ?? '-' }}</td>

            <td class="p-3 text-center">
                <div class="flex gap-2 justify-center">

                    <a href="{{ route('admin.departments.show', $d->id) }}"
                       class="px-16 py-1 bg-blue-500/40 hover:bg-blue-500/60
                       border border-white/20 rounded-lg font-semibold transition">
                        Detail
                    </a>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center py-4 text-white/60">Belum ada data jurusan.</td>
        </tr>
    @endforelse
@endsection

{{-- MOBILE CARDS LAYOUT --}}
@section('tableRowsDataMobile')
    @forelse($departments as $d)
        <div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-2xl p-4 sm:p-5 shadow-2xl">

            <h3 class="text-lg sm:text-xl font-bold">{{ $d->name }}</h3>
            <p class="text-white/70 text-sm mt-1">Kode: {{ $d->code ?? '-' }}</p>

            <div class="mt-4 bg-white/5 p-3 rounded-xl text-sm">
                <span class="text-xs opacity-70">Deskripsi</span>
                <p class="font-semibold">{{ $d->description ?? '-' }}</p>
            </div>

            <div class="mt-5 grid grid-cols-1 gap-3">

                <a href="{{ route('admin.departments.show', $d->id) }}"
                   class="px-4 py-3 bg-blue-500/40 border border-white/20 rounded-xl font-semibold text-center">
                    Detail
                </a>
            </div>

        </div>
    @empty
        <p class="text-center text-white/70">Belum ada data jurusan.</p>
    @endforelse
@endsection

@section('pagination')
    {{ $departments->links() }}
@endsection
