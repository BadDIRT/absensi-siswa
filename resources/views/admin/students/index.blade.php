@extends('layouts.indexMain')

@section('headerTitle', 'ABSENSIKU - Data Siswa/i')
@section('pageTitle', 'Data Siswa/i')
@section('routeCreate', route('students.create'))
@section('createButtonText', '+ Tambah Siswa')

@section('searching')
    <option value="name" class="text-black" {{ request('filter_field') == 'name' ? 'selected' : '' }}>Nama</option>
    <option value="gender" class="text-black" {{ request('filter_field') == 'gender' ? 'selected' : '' }}>Jenis Kelamin</option>
    <option value="nisn" class="text-black" {{ request('filter_field') == 'nisn' ? 'selected' : '' }}>NISN</option>
    <option value="class" class="text-black" {{ request('filter_field') == 'class' ? 'selected' : '' }}>Kelas</option>
    <option value="department" class="text-black" {{ request('filter_field') == 'department' ? 'selected' : '' }}>Jurusan</option>
@endsection

@section('title', 'Daftar Siswa/i')

{{-- ================= DESKTOP TABLE ================= --}}
@section('thead')
    <th class="p-3">No</th>
    <th class="p-3">Nama</th>
    <th class="p-3">JK</th>
    <th class="p-3">Tanggal Lahir</th>
    <th class="p-3">NISN</th>
    <th class="p-3">NIPD</th>
    <th class="p-3">Alamat</th>
    <th class="p-3">Kelas</th>
    <th class="p-3">Jurusan</th>
    <th class="p-3 text-center">Aksi</th>
@endsection

@section('tableRowsData')
    @forelse($students as $s)
        <tr class="border-b border-white/10 hover:bg-white/10 transition-all duration-300">
            <td class="p-3">{{ $loop->iteration }}</td>
            <td class="p-3">{{ $s->name }}</td>
            <td class="p-3">{{ $s->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            <td class="p-3">
                {{ \Carbon\Carbon::parse($s->date_of_birth)->translatedFormat('d F Y') }}
            </td>
            <td class="p-3">{{ $s->nisn }}</td>
            <td class="p-3">{{ $s->nipd }}</td>
            <td class="p-3">{{ $s->address ?? '-' }}</td>
            <td class="p-3">{{ $s->class->grade ?? '-' }}</td>
            <td class="p-3">{{ $s->department->name ?? '-' }}</td>

            <td class="p-3 text-center">
                <div class="flex gap-2 justify-center">
                    <a href="{{ route('students.show', $s->id) }}"
                       class="px-16 py-1 bg-blue-500/40 hover:bg-blue-500/60 border border-white/20 rounded-lg font-semibold transition">
                        Detail
                    </a>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="10" class="text-center py-4 text-white/60">
                Belum ada data siswa.
            </td>
        </tr>
    @endforelse
@endsection

{{-- ================= MOBILE CARD ================= --}}
@section('tableRowsDataMobile')
    @forelse($students as $s)
        <div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-2xl p-4 sm:p-5 shadow-2xl">

            <div class="flex justify-between items-center">
                <h3 class="text-lg sm:text-xl font-bold">{{ $s->name }}</h3>
                <span class="text-xs sm:text-sm bg-white/10 px-3 py-1 rounded-lg">
                    {{ $s->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}
                </span>
            </div>

            <div class="mt-4 grid grid-cols-2 gap-3 text-sm">

                <div class="flex flex-col bg-white/5 p-3 rounded-xl">
                    <span class="text-xs opacity-70">📅 Tanggal Lahir</span>
                    <span class="font-semibold">
                        {{ \Carbon\Carbon::parse($s->date_of_birth)->translatedFormat('d F Y') }}
                    </span>
                </div>

                <div class="flex flex-col bg-white/5 p-3 rounded-xl">
                    <span class="text-xs opacity-70">🎓 Kelas</span>
                    <span class="font-semibold">{{ $s->class->grade ?? '-' }}</span>
                </div>

                <div class="flex flex-col bg-white/5 p-3 rounded-xl col-span-2">
                    <span class="text-xs opacity-70">🏫 Jurusan</span>
                    <span class="font-semibold">{{ $s->department->name ?? '-' }}</span>
                </div>

                <div class="flex flex-col bg-white/5 p-3 rounded-xl col-span-2">
                    <span class="text-xs opacity-70">📍 Alamat</span>
                    <span class="font-semibold">{{ $s->address ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-5 grid grid-cols-1 gap-3">
                <a href="{{ route('students.show', $s->id) }}"
                   class="px-4 py-3 bg-blue-500/40 border border-white/20 rounded-xl font-semibold text-center">
                    Detail
                </a>
            </div>

        </div>
    @empty
        <p class="text-center text-white/70">Belum ada data siswa.</p>
    @endforelse
@endsection

@section('pagination')
    {{ $students->links() }}
@endsection
