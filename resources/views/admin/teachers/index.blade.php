@extends('layouts.indexMain')

@section('headerTitle', 'ABSENSIKU - Data Guru')
@section('pageTitle', 'Data Guru')
@section('routeCreate', route('admin.teachers.create'))
@section('createButtonText', '+ Tambah Guru')

{{-- FILTER OPTIONAL (jika belum ada, bisa kosong) --}}
@section('searching')
    <option value="name" class="text-black" {{ request('filter_field') == 'name' ? 'selected' : '' }}>Nama</option>
    <option value="nip" class="text-black" {{ request('filter_field') == 'nip' ? 'selected' : '' }}>NIP</option>
    <option value="gender" class="text-black" {{ request('filter_field') == 'gender' ? 'selected' : '' }}>Jenis Kelamin</option>
@endsection

@section('title', 'Daftar Guru')

{{-- TABLE HEADER --}}
@section('thead')
    <th class="p-3">No</th>
    <th class="p-3">Nama</th>
    <th class="p-3">NIP</th>
    <th class="p-3">JK</th>
    <th class="p-3">No Telepon</th>
    <th class="p-3 text-center">Aksi</th>
@endsection

{{-- DESKTOP TABLE ROWS --}}
@section('tableRowsData')
    @forelse($teachers as $t)
        <tr class="border-b border-white/10 hover:bg-white/10 transition-all duration-300">
            <td class="p-3">{{ $loop->iteration }}</td>
            <td class="p-3">{{ $t->name }}</td>
            <td class="p-3">{{ $t->nip ?? '-' }}</td>
            <td class="p-3">
                {{ $t->gender === 'L' ? 'Laki-laki' : ($t->gender === 'P' ? 'Perempuan' : '-') }}
            </td>
            <td class="p-3">{{ $t->phone_number ?? '-' }}</td>

            <td class="p-3 text-center">
                <div class="flex gap-2 justify-center">
                    <a href="{{ route('admin.teachers.show', $t->id) }}"
                        class="px-16 py-1 bg-blue-500/40 hover:bg-blue-500/60 border border-white/20 rounded-lg transition">
                        Detail
                    </a>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center py-4 text-white/60">Belum ada data guru.</td>
        </tr>
    @endforelse
@endsection

{{-- MOBILE LIST --}}
@section('tableRowsDataMobile')
    @forelse($teachers as $t)
        <div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-2xl p-4 sm:p-5 shadow-2xl">

            <h3 class="text-lg sm:text-xl font-bold">{{ $t->name }}</h3>
            <p class="text-sm opacity-70">{{ $t->nip ?? '-' }}</p>

            <div class="mt-4 grid grid-cols-2 gap-3 text-sm">
                <div class="flex flex-col bg-white/5 p-3 rounded-xl">
                    <span class="text-xs opacity-70">Jenis Kelamin</span>
                    <span class="font-semibold">
                        {{ $t->gender === 'L' ? 'Laki-laki' : ($t->gender === 'P' ? 'Perempuan' : '-') }}
                    </span>
                </div>

                <div class="flex flex-col bg-white/5 p-3 rounded-xl">
                    <span class="text-xs opacity-70">No Telepon</span>
                    <span class="font-semibold">{{ $t->phone_number ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-5 grid grid-cols-1 gap-3">
                <a href="{{ route('admin.teachers.show', $t->id) }}"
                   class="px-4 py-3 bg-blue-500/40 border border-white/20 rounded-xl font-semibold text-center">
                    Detail
                </a>
            </div>
        </div>

    @empty
        <p class="text-center text-white/70">Belum ada data guru.</p>
    @endforelse
@endsection

{{-- PAGINATION --}}
@section('pagination')
    {{ $teachers->links() }}
@endsection
