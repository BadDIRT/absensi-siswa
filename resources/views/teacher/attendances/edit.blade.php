@extends('layouts.editMain')

@section('title', 'ABSENSIKU - Edit Absensi')

@section('header')
<header class="sticky top-0 z-40 w-full bg-white/10 backdrop-blur-2xl border-b border-white/10 shadow-xl p-3 sm:p-4 flex items-center justify-between rounded-2xl">
    <div class="flex items-center gap-3">
        <button 
            @click="sidebarOpen = !sidebarOpen" 
            class="text-white text-2xl font-bold transform transition duration-300 hover:scale-125 hover:text-blue-300">
            ☰
        </button>
        <h1 class="text-xl sm:text-2xl font-bold drop-shadow">Edit Data Absensi</h1>
    </div>
</header>
@endsection

@section('content')

<div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-3xl shadow-2xl p-6 sm:p-8 
            transition-all duration-500 hover:shadow-blue-500/30 hover:-translate-y-1">

    <h2 class="text-lg sm:text-2xl font-bold mb-6">Form Edit Absensi</h2>

    <form method="POST" action="{{ route('attendances.update', $attendance->id) }}" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- SISWA --}}
        <div>
            <label class="font-semibold text-sm">Siswa</label>
            <select name="student_id"
                class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 text-white backdrop-blur-xl
                       transition hover:bg-white/20 focus:ring-2 focus:ring-blue-400">
                @foreach ($students as $s)
                    <option class="text-black" value="{{ $s->id }}"
                        {{ old('student_id', $attendance->student_id) == $s->id ? 'selected' : '' }}>
                        {{ $s->name }}
                    </option>
                @endforeach
            </select>
            @error('student_id')
                <p class="mt-2 text-red-400 text-sm font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- GURU --}}
        <div>
            <label class="font-semibold text-sm">Guru</label>
            <select name="teacher_id"
                class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 text-white backdrop-blur-xl
                       transition hover:bg-white/20 focus:ring-2 focus:ring-blue-400">
                @foreach ($teachers as $t)
                    <option class="text-black" value="{{ $t->id }}"
                        {{ old('teacher_id', $attendance->teacher_id) == $t->id ? 'selected' : '' }}>
                        {{ $t->name }}
                    </option>
                @endforeach
            </select>
            @error('teacher_id')
                <p class="mt-2 text-red-400 text-sm font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- TANGGAL --}}
        <div>
            <label class="font-semibold text-sm">Tanggal</label>
            <input type="date" name="date"
                   value="{{ old('date', $attendance->date) }}"
                   class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 text-white backdrop-blur-xl
                          transition hover:bg-white/20 focus:ring-2 focus:ring-blue-400">
            @error('date')
                <p class="mt-2 text-red-400 text-sm font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- JAM MASUK --}}
        <div>
            <label class="font-semibold text-sm">Jam Masuk</label>
            <input type="time" name="time_in"
                   value="{{ old('time_in', $attendance->time_in) }}"
                   class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 text-white backdrop-blur-xl
                          transition hover:bg-white/20 focus:ring-2 focus:ring-blue-400">
            @error('time_in')
                <p class="mt-2 text-red-400 text-sm font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- JAM PULANG --}}
        <div>
            <label class="font-semibold text-sm">Jam Pulang</label>
            <input type="time" name="time_out"
                   value="{{ old('time_out', $attendance->time_out) }}"
                   class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 text-white backdrop-blur-xl
                          transition hover:bg-white/20 focus:ring-2 focus:ring-blue-400">
            @error('time_out')
                <p class="mt-2 text-red-400 text-sm font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- STATUS --}}
        <div>
            <label class="font-semibold text-sm">Status</label>
            <select name="status"
                class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 text-white backdrop-blur-xl
                       transition hover:bg-white/20 focus:ring-2 focus:ring-blue-400">
                @foreach (['hadir','izin','sakit','alfa'] as $status)
                    <option class="text-black" value="{{ $status }}"
                        {{ old('status', $attendance->status) == $status ? 'selected' : '' }}>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
            @error('status')
                <p class="mt-2 text-red-400 text-sm font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- BUTTON --}}
        <div class="flex flex-col sm:flex-row gap-3 pt-4">
            <a href="{{ route('attendances.index') }}"
               class="px-5 py-3 bg-white/20 hover:bg-white/30 border border-white/30 rounded-xl font-semibold text-center transition">
                Kembali
            </a>

            <button type="submit"
                class="px-5 py-3 bg-blue-600/60 hover:bg-blue-600/80 border border-white/20 rounded-xl font-semibold transition">
                Update Absensi
            </button>
        </div>

    </form>
</div>

@endsection
