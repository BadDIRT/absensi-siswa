@extends('layouts.showMain')

@section('title', 'ABSENSIKU - Detail Jadwal')

@section('header')
<header class="sticky top-0 z-40 w-full bg-white/10 backdrop-blur-2xl border-b border-white/10 shadow-xl 
        p-3 sm:p-4 flex items-center justify-between rounded-2xl">
    <div class="flex items-center gap-3">
        <button 
            @click="sidebarOpen = !sidebarOpen" 
            class="text-white text-2xl font-bold transform transition duration-300 hover:scale-125 hover:text-blue-300">
            ☰
        </button>
        <h1 class="text-xl sm:text-2xl font-bold drop-shadow">Detail Jadwal Pelajaran</h1>
    </div>
</header>
@endsection

@section('content')

<div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-3xl shadow-2xl p-6 sm:p-8 
            transition-all duration-500 hover:shadow-blue-500/30 hover:shadow-2xl">

    <h2 class="text-lg sm:text-2xl font-bold mb-6">Informasi Jadwal</h2>

    <div class="grid sm:grid-cols-2 gap-6 text-white">

        <div class="bg-white/5 p-4 rounded-2xl border border-white/10">
            <p class="text-sm opacity-80">Hari</p>
            <p class="text-xl font-bold mt-1">{{ $timetable->day }}</p>
        </div>

        <div class="bg-white/5 p-4 rounded-2xl border border-white/10">
            <p class="text-sm opacity-80">Waktu</p>
            <p class="text-xl font-bold mt-1">
                {{ $timetable->start_time }} - {{ $timetable->end_time }}
            </p>
        </div>

        <div class="bg-white/5 p-4 rounded-2xl border border-white/10">
            <p class="text-sm opacity-80">Mata Pelajaran</p>
            <p class="text-xl font-bold mt-1">{{ $timetable->subject->name }}</p>
        </div>

        <div class="bg-white/5 p-4 rounded-2xl border border-white/10">
            <p class="text-sm opacity-80">Guru</p>
            <p class="text-xl font-bold mt-1">{{ $timetable->teacher->name }}</p>
        </div>

        <div class="bg-white/5 p-4 rounded-2xl border border-white/10">
            <p class="text-sm opacity-80">Kelas</p>
            <p class="text-xl font-bold mt-1">
                {{ $timetable->class->grade }}
            </p>
        </div>

    </div>

    {{-- BUTTONS --}}
    <div class="flex flex-col sm:flex-row gap-3 mt-8">

        <a href="{{ route('timetables.index') }}"
            class="px-5 py-3 bg-white/20 hover:bg-white/30 border border-white/30 rounded-xl font-semibold text-center backdrop-blur-xl
                    transition duration-300 transform hover:-translate-y-1 hover:shadow-lg hover:shadow-white/20">
            Kembali
        </a>

        <a href="{{ route('timetables.edit', $timetable->id) }}"
            class="px-5 py-3 bg-yellow-500/60 hover:bg-yellow-500/80 border border-white/20 rounded-xl font-semibold backdrop-blur-xl text-center
                    transition duration-300 transform hover:-translate-y-1 hover:shadow-lg hover:shadow-yellow-500/30">
            Edit
        </a>

        <button 
            @click="confirmDelete = true"
            class="px-5 py-3 bg-red-600/60 hover:bg-red-600/80 border border-white/20 rounded-xl font-semibold backdrop-blur-xl w-full sm:w-auto
                    transition duration-300 transform hover:-translate-y-1 hover:shadow-lg hover:shadow-red-500/30">
            Hapus
        </button>
    </div>

</div>

@endsection

@section('modal')
{{-- DELETE MODAL --}}
<div 
    x-show="confirmDelete"
    x-transition.opacity
    class="fixed inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm z-[999]"
>
    <div x-transition.scale
        class="bg-white/10 border border-white/20 rounded-3xl p-6 w-80 backdrop-blur-xl shadow-2xl"
    >
        <h2 class="text-xl font-bold mb-4">Hapus Jadwal?</h2>
        <p class="text-sm mb-6 opacity-80">Tindakan ini tidak dapat dibatalkan.</p>

        <div class="flex gap-3">
            <button 
                @click="confirmDelete = false"
                class="px-4 py-2 w-full bg-white/20 hover:bg-white/30 border border-white/30 rounded-xl">
                Batal
            </button>

            <form action="{{ route('timetables.destroy', $timetable->id) }}" method="POST" class="w-full">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="px-4 py-2 w-full bg-red-600/70 hover:bg-red-600/90 border border-white/20 rounded-xl">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
