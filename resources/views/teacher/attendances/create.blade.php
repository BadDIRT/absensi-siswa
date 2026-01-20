@extends('layouts.createMain')

@section('title', 'Tambah Absensi')

@section('header')
<header
    class="sticky top-0 z-40 w-full bg-white/10 backdrop-blur-2xl border-b border-white/10 shadow-xl
           p-3 sm:p-4 flex items-center justify-between rounded-2xl">
    <div class="flex items-center gap-3">
        <button
            @click="sidebarOpen = !sidebarOpen"
            class="text-white text-2xl font-bold transform transition duration-300 hover:scale-125 hover:text-blue-300">
            ☰
        </button>
        <h1 class="text-xl sm:text-2xl font-bold drop-shadow">Tambah Data Absensi</h1>
    </div>
</header>
@endsection

@section('content')

<div
    class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-3xl shadow-2xl p-6 sm:p-8
           transition-all duration-500 hover:shadow-blue-500/30 hover:shadow-2xl hover:-translate-y-1">

    <h2 class="text-lg sm:text-2xl font-bold mb-6">Form Tambah Absensi</h2>

    <form action="{{ route('attendances.store') }}" method="POST"
      x-data="{ status: '{{ old('status') }}' }"
      class="space-y-5">

        @csrf

        <!-- TANGGAL -->
        <div>
            <label class="font-semibold text-sm">Tanggal Absensi</label>
            <input type="date" name="date"
                value="{{ old('date') }}"
                class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl text-white
                       transition duration-300 hover:bg-white/20 focus:bg-white/30 focus:ring-2 focus:ring-blue-400">

            @error('date')
                <p class="mt-2 text-red-400 drop-shadow-[0_0_6px_rgba(255,0,0,0.8)] text-sm font-semibold">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- SISWA -->
        <div>
            <label class="font-semibold text-sm">Siswa</label>
            <select name="student_id"
                class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl text-white
                       transition duration-300 hover:bg-white/20 focus:bg-white/30 focus:ring-2 focus:ring-blue-400">
                <option value="" class="text-black">-- Pilih Siswa --</option>
                @foreach ($students as $s)
                    <option class="text-black" value="{{ $s->id }}"
                        {{ old('student_id') == $s->id ? 'selected' : '' }}>
                        {{ $s->name }}
                    </option>
                @endforeach
            </select>

            @error('student_id')
                <p class="mt-2 text-red-400 drop-shadow-[0_0_6px_rgba(255,0,0,0.8)] text-sm font-semibold">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- GURU -->
        <div>
            <label class="font-semibold text-sm">Guru</label>
            <select name="teacher_id"
                class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl text-white
                       transition duration-300 hover:bg-white/20 focus:bg-white/30 focus:ring-2 focus:ring-blue-400">
                <option value="" class="text-black">-- Pilih Guru --</option>
                @foreach ($teachers as $t)
                    <option class="text-black" value="{{ $t->id }}"
                        {{ old('teacher_id') == $t->id ? 'selected' : '' }}>
                        {{ $t->name }}
                    </option>
                @endforeach
            </select>

            @error('teacher_id')
                <p class="mt-2 text-red-400 drop-shadow-[0_0_6px_rgba(255,0,0,0.8)] text-sm font-semibold">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- JAM MASUK -->
        <div>
            <label class="font-semibold text-sm">Jam Masuk</label>
            <input type="time" name="time_in"
                value="{{ old('time_in') }}"
                class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl text-white
                       transition duration-300 hover:bg-white/20 focus:bg-white/30 focus:ring-2 focus:ring-blue-400">

            @error('time_in')
                <p class="mt-2 text-red-400 drop-shadow-[0_0_6px_rgba(255,0,0,0.8)] text-sm font-semibold">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- JAM PULANG -->
<div x-show="status === 'hadir'"
     x-transition.opacity
     x-effect="if(status !== 'hadir') $refs.timeOut.value = ''">

    <label class="font-semibold text-sm">Jam Pulang</label>
    <input type="time" name="time_out"
           x-ref="timeOut"
           value="{{ old('time_out') }}"
           class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl text-white
                  transition duration-300 hover:bg-white/20 focus:bg-white/30 focus:ring-2 focus:ring-blue-400">

    @error('time_out')
        <p class="mt-2 text-red-400 drop-shadow-[0_0_6px_rgba(255,0,0,0.8)] text-sm font-semibold">
            {{ $message }}
        </p>
    @enderror
</div>


        <!-- STATUS -->
        <div>
            <label class="font-semibold text-sm">Status Kehadiran</label>
            <select name="status"
    x-model="status"
    class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl text-white
           transition duration-300 hover:bg-white/20 focus:bg-white/30 focus:ring-2 focus:ring-blue-400">

                <option value="" class="text-black">-- Pilih Status --</option>
                <option class="text-black" value="hadir" {{ old('status') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                <option class="text-black" value="izin" {{ old('status') == 'izin' ? 'selected' : '' }}>Izin</option>
                <option class="text-black" value="sakit" {{ old('status') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                <option class="text-black" value="tidak hadir" {{ old('status') == 'tidak hadir' ? 'selected' : '' }}>
                    Tidak Hadir
                </option>
            </select>

            @error('status')
                <p class="mt-2 text-red-400 drop-shadow-[0_0_6px_rgba(255,0,0,0.8)] text-sm font-semibold">
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- BUTTON --}}
        <div class="flex flex-col sm:flex-row gap-3 pt-4">

            <a href="{{ route('attendances.index') }}"
               class="px-5 py-3 bg-white/20 hover:bg-white/30 border border-white/30 rounded-xl font-semibold text-center backdrop-blur-xl
                      transition duration-300 transform hover:-translate-y-1 hover:shadow-lg hover:shadow-white/20">
                Kembali
            </a>

            <button type="submit"
                class="px-5 py-3 bg-blue-600/60 hover:bg-blue-600/80 border border-white/20 rounded-xl font-semibold backdrop-blur-xl w-full sm:w-auto
                       transition duration-300 transform hover:-translate-y-1 hover:shadow-lg hover:shadow-blue-500/30">
                Simpan Data Absensi
            </button>
        </div>

    </form>
</div>

@endsection
