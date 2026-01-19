@extends('layouts.indexSecondary')

@section('headerTitle', 'ABSENSIKU - Data Absensi')
@section('pageTitle', 'Data Absensi')
@section('routePrimary', route('attendances.scan.form'))
@section('primaryButtonText', 'Pindai Kode Batang')
@section('routeSecondary', route('attendances.create'))
@section('secondaryButtonText', 'Tambah Absensi Manual')

{{-- ================= FILTER / SEARCH ================= --}}
@section('searching')
    <option value="name" class="text-black" {{ request('filter_field') == 'name' ? 'selected' : '' }}>Nama Siswa</option>
    <option value="date" class="text-black" {{ request('filter_field') == 'date' ? 'selected' : '' }}>Tanggal</option>
    <option value="status" class="text-black" {{ request('filter_field') == 'status' ? 'selected' : '' }}>Status</option>
@endsection

@section('title', 'Daftar Absensi')

{{-- ================= DESKTOP TABLE ================= --}}
@section('thead')
    <th class="p-3">No</th>
    <th class="p-3">Nama Siswa</th>
    <th class="p-3">Tanggal</th>
    <th class="p-3">Jam Masuk</th>
    <th class="p-3">Jam Pulang</th>
    <th class="p-3">Status</th>
    <th class="p-3 text-center">Aksi</th>
@endsection

@section('tableRowsData')
    @forelse($attendances as $a)
        <tr class="border-b border-white/10 hover:bg-white/10 transition-all duration-300">
            <td class="p-3">{{ $loop->iteration }}</td>
            <td class="p-3">{{ $a->student->name ?? '-' }}</td>
            <td class="p-3">
                {{ \Carbon\Carbon::parse($a->date)->translatedFormat('d F Y') }}
            </td>
            <td class="p-3">{{ $a->time_in ?? '-' }}</td>
            <td class="p-3">{{ $a->time_out ?? '-' }}</td>
            <td class="p-3">
                <span class="px-3 py-1 rounded-lg text-xs font-semibold
                    @if($a->status === 'hadir') bg-green-500/30
                    @elseif($a->status === 'izin') bg-blue-500/30
                    @elseif($a->status === 'sakit') bg-yellow-500/30
                    @else bg-red-500/30
                    @endif">
                    {{ ucfirst($a->status) }}
                </span>
            </td>
            <td class="p-3 text-center">
                <a href="{{ route('attendances.show', $a->id) }}"
                   class="px-10 py-1 bg-blue-500/40 hover:bg-blue-500/60 border border-white/20 rounded-lg font-semibold transition">
                    Detail
                </a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8" class="text-center py-4 text-white/60">
                Belum ada data absensi.
            </td>
        </tr>
    @endforelse
@endsection

{{-- ================= MOBILE CARD ================= --}}
@section('tableRowsDataMobile')
    @forelse($attendances as $a)
        <div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-2xl p-4 shadow-2xl">

            <div class="flex justify-between items-center">
                <h3 class="text-lg font-bold">{{ $a->student->name ?? '-' }}</h3>
                <span class="text-xs px-3 py-1 rounded-lg
                    @if($a->status === 'hadir') bg-green-500/30
                    @elseif($a->status === 'izin') bg-blue-500/30
                    @elseif($a->status === 'sakit') bg-yellow-500/30
                    @else bg-red-500/30
                    @endif">
                    {{ ucfirst($a->status) }}
                </span>
            </div>

            <div class="mt-4 grid grid-cols-2 gap-3 text-sm">
                <div class="flex flex-col bg-white/5 p-3 rounded-xl">
                    <span class="text-xs opacity-70">📅 Tanggal</span>
                    <span class="font-semibold">
                        {{ \Carbon\Carbon::parse($a->date)->translatedFormat('d F Y') }}
                    </span>
                </div>


                <div class="flex flex-col bg-white/5 p-3 rounded-xl">
                    <span class="text-xs opacity-70">⏰ Masuk</span>
                    <span class="font-semibold">{{ $a->time_in ?? '-' }}</span>
                </div>

                <div class="flex flex-col bg-white/5 p-3 rounded-xl">
                    <span class="text-xs opacity-70">🚪 Pulang</span>
                    <span class="font-semibold">{{ $a->time_out ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-5">
                <a href="{{ route('attendances.show', $a->id) }}"
                class="px-4 py-3 bg-blue-500/40 border border-white/20 rounded-xl font-semibold text-center block">
                    Detail
                </a>
            </div>

        </div>
    @empty
        <p class="text-center text-white/70">Belum ada data absensi.</p>
    @endforelse
@endsection

@section('pagination')
    {{ $attendances->links() }}
@endsection
