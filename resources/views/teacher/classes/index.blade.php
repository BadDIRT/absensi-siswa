@extends('layouts.indexMain')

@section('headerTitle', 'ABSENSIKU - Data Kelas')
@section('pageTitle', 'Data Kelas')
@section('routeCreate', route('classes.create'))
@section('createButtonText', '+ Tambah Kelas')

@section('searching')
    <option value="department" class="text-black" {{ request('filter_field') == 'department' ? 'selected' : '' }}>
        Jurusan
    </option>
    <option value="grade" class="text-black" {{ request('filter_field') == 'grade' ? 'selected' : '' }}>
        Tingkat
    </option>
    <option value="teacher" class="text-black" {{ request('filter_field') == 'teacher' ? 'selected' : '' }}>
        Wali Kelas
    </option>
@endsection

@section('title', 'Daftar Kelas')

{{-- ===================== DESKTOP TABLE ===================== --}}
@section('thead')
    <th class="p-3">No</th>
    <th class="p-3">Jurusan</th>
    <th class="p-3">Tingkat</th>
    <th class="p-3">Wali Kelas</th>
    <th class="p-3 text-center">Aksi</th>
@endsection

@section('tableRowsData')
    @forelse($classes as $c)
        <tr class="border-b border-white/10 hover:bg-white/10 transition-all duration-300">
            <td class="p-3">{{ $loop->iteration }}</td>
            <td class="p-3">{{ $c->department->name ?? '-' }}</td>
            <td class="p-3">{{ $c->grade }}</td>
            <td class="p-3">{{ $c->teacher->name ?? '-' }}</td>

            <td class="p-3 text-center">
                <div class="flex gap-2 justify-center">
                    <a href="{{ route('classes.show', $c->id) }}"
                       class="px-16 py-1 bg-blue-500/40 hover:bg-blue-500/60 border border-white/20 rounded-lg font-semibold transition">
                        Detail
                    </a>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center py-4 text-white/60">
                Belum ada data kelas.
            </td>
        </tr>
    @endforelse
@endsection

{{-- ===================== MOBILE CARDS ===================== --}}
@section('tableRowsDataMobile')
    @forelse($classes as $c)
        <div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-2xl p-4 sm:p-5 shadow-2xl">

            <h3 class="text-lg sm:text-xl font-bold">
                {{ $c->department->name ?? '-' }}
            </h3>

            <div class="mt-4 grid grid-cols-2 gap-3 text-sm">
                <div class="flex flex-col bg-white/5 p-3 rounded-xl">
                    <span class="text-xs opacity-70">Tingkat</span>
                    <span class="font-semibold">{{ $c->grade }}</span>
                </div>

                <div class="flex flex-col bg-white/5 p-3 rounded-xl">
                    <span class="text-xs opacity-70">Wali Kelas</span>
                    <span class="font-semibold">{{ $c->teacher->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-5 grid grid-cols-1 gap-3">
                <a href="{{ route('classes.show', $c->id) }}"
                   class="px-4 py-3 bg-blue-500/40 border border-white/20 rounded-xl font-semibold text-center">
                    Detail
                </a>
            </div>
        </div>
    @empty
        <p class="text-center text-white/70">Belum ada data kelas.</p>
    @endforelse
@endsection

@section('pagination')
    {{ $classes->links() }}
@endsection
