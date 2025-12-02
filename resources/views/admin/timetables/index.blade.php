@extends('layouts.indexMain')

@section('headerTitle', 'ABSENSIKU - Jadwal Pelajaran')
@section('pageTitle', 'Jadwal Pelajaran')
@section('routeCreate', route('timetables.create'))
@section('createButtonText', '+ Tambah Jadwal')

@section('searching')
    <option value="day" class="text-black" {{ request('filter_field') == 'day' ? 'selected' : '' }}>Hari</option>
    <option value="teacher" class="text-black" {{ request('filter_field') == 'teacher' ? 'selected' : '' }}>Guru</option>
    <option value="class" class="text-black" {{ request('filter_field') == 'class' ? 'selected' : '' }}>Kelas</option>
    <option value="start_time" class="text-black" {{ request('filter_field') == 'start_time' ? 'selected' : '' }}>Jam Mulai</option>
    <option value="end_time" class="text-black" {{ request('filter_field') == 'end_time' ? 'selected' : '' }}>Jam Selesai</option>
@endsection

@section('title', 'Daftar Jadwal Pelajaran')

@section('thead')
    <th class="p-3">No</th>
    <th class="p-3">Hari</th>
    <th class="p-3">Mata Pelajaran</th>
    <th class="p-3">Guru</th>
    <th class="p-3">Jam Mulai</th>
    <th class="p-3">Jam Selesai</th>
    <th class="p-3">Kelas</th>
    <th class="p-3 text-center">Aksi</th>
@endsection

@section('tableRowsData')
    @forelse($timetables as $t)
        <tr class="border-b border-white/10 hover:bg-white/10 transition-all duration-300">
            <td class="p-3">{{ $loop->iteration }}</td>
            <td class="p-3">{{ $t->day }}</td>
            <td class="p-3">{{ $t->subject->name }}</td>
            <td class="p-3">{{ $t->teacher->name }}</td>
            <td class="p-3">{{ $t->start_time }}</td>
            <td class="p-3">{{ $t->end_time }}</td>
            <td class="p-3">{{ $t->class->grade }}</td>

            <td class="p-3 text-center">
                <div class="flex gap-2 justify-center">
                    <a href="{{ route('timetables.show', $t->id) }}"
                        class="px-16 py-1 bg-blue-500/40 hover:bg-blue-500/60 border border-white/20 rounded-lg font-semibold transition">
                        Detail
                    </a>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8" class="text-center py-4 text-white/60">Belum ada Jadwal.</td>
        </tr>
    @endforelse
@endsection

@section('tableRowsDataMobile')
    @forelse($timetables as $t)
        <div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-2xl p-4 sm:p-5 shadow-2xl">

            <div class="flex justify-between items-center">
                <h3 class="text-lg sm:text-xl font-bold">{{ $t->subject->name }}</h3>
                <span class="text-xs sm:text-sm bg-white/10 px-3 py-1 rounded-lg">{{ $t->day }}</span>
            </div>

            <div class="mt-4 grid grid-cols-2 gap-3 text-sm">
                <div class="flex flex-col bg-white/5 p-3 rounded-xl">
                    <span class="text-xs opacity-70">👤 Guru</span>
                    <span class="font-semibold">{{ $t->teacher->name }}</span>
                </div>

                <div class="flex flex-col bg-white/5 p-3 rounded-xl">
                    <span class="text-xs opacity-70">🏫 Kelas</span>
                    <span class="font-semibold">{{ $t->class->grade }}</span>
                </div>

                <div class="flex flex-col bg-white/5 p-3 rounded-xl col-span-2">
                    <span class="text-xs opacity-70">🕒 Jam Pelajaran</span>
                    <span class="font-semibold">{{ $t->start_time }} – {{ $t->end_time }}</span>
                </div>
            </div>

            <div class="mt-5 grid grid-cols-1 gap-3">
                <a href="{{ route('timetables.show', $t->id) }}"
                    class="px-4 py-3 bg-blue-500/40 border border-white/20 rounded-xl font-semibold text-center">
                    Detail
                </a>
            </div>

        </div>
    @empty
        <p class="text-center text-white/70">Belum ada Jadwal.</p>
    @endforelse
@endsection

@section('pagination')
    {{ $timetables->links() }}
@endsection
