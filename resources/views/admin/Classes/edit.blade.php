@extends('layouts.editMain')

@section('title', 'ABSENSIKU - Edit Kelas')

@section('header')
<header class="sticky top-0 z-40 w-full bg-white/10 backdrop-blur-2xl border-b border-white/10 shadow-xl p-3 sm:p-4 flex items-center justify-between rounded-2xl">
    <div class="flex items-center gap-3">
        <button 
            @click="sidebarOpen = !sidebarOpen" 
            class="text-white text-2xl font-bold transform transition duration-300 hover:scale-125 hover:text-blue-300">
            ☰
        </button>
        <h1 class="text-xl sm:text-2xl font-bold drop-shadow">Edit Data Kelas</h1>
    </div>
</header>
@endsection


@section('content')

<div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-3xl shadow-2xl p-6 sm:p-8 
            transition-all duration-500 hover:shadow-blue-500/30 hover:shadow-2xl hover:-translate-y-1">

    <h2 class="text-lg sm:text-2xl font-bold mb-6">Form Edit Kelas</h2>

    <form action="{{ route('admin.classes.update', $class->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- GRADE --}}
        <div>
            <label class="font-semibold text-sm">Tingkat (Grade)</label>
            <select name="grade"
                class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl text-white
                       transition duration-300 hover:bg-white/20 focus:bg-white/30 focus:ring-2 focus:ring-blue-400">
                <option class="text-black" value="">-- Pilih Tingkat --</option>
                <option class="text-black" value="10" {{ old('grade', $class->grade) == 10 ? 'selected' : '' }}>10</option>
                <option class="text-black" value="11" {{ old('grade', $class->grade) == 11 ? 'selected' : '' }}>11</option>
                <option class="text-black" value="12" {{ old('grade', $class->grade) == 12 ? 'selected' : '' }}>12</option>
            </select>

            @error('grade')
                <p class="mt-2 text-red-400 drop-shadow-[0_0_6px_rgba(255,0,0,0.8)] text-sm font-semibold">
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- JURUSAN --}}
        <div>
            <label class="font-semibold text-sm">Jurusan</label>
            <select name="department_id"
                class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl text-white
                       transition duration-300 hover:bg-white/20 focus:bg-white/30 focus:ring-2 focus:ring-blue-400">
                <option class="text-black" value="">-- Pilih Jurusan --</option>
                @foreach ($departments as $dept)
                    <option class="text-black" value="{{ $dept->id }}"
                        {{ old('department_id', $class->department_id) == $dept->id ? 'selected' : '' }}>
                        {{ $dept->name }}
                    </option>
                @endforeach
            </select>

            @error('department_id')
                <p class="mt-2 text-red-400 drop-shadow-[0_0_6px_rgba(255,0,0,0.8)] text-sm font-semibold">
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- WALI KELAS --}}
        <div>
            <label class="font-semibold text-sm">Wali Kelas</label>
            <select name="teacher_id"
                class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl text-white
                       transition duration-300 hover:bg-white/20 focus:bg-white/30 focus:ring-2 focus:ring-blue-400">
                <option class="text-black" value="">-- Pilih Wali Kelas --</option>
                @foreach ($teachers as $t)
                    <option class="text-black" value="{{ $t->id }}"
                        {{ old('teacher_id', $class->teacher_id) == $t->id ? 'selected' : '' }}>
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

        {{-- BUTTONS --}}
        <div class="flex flex-col sm:flex-row gap-3 pt-4">

            <a href="{{ route('admin.classes.index') }}"
               class="px-5 py-3 bg-white/20 hover:bg-white/30 border border-white/30 rounded-xl font-semibold text-center backdrop-blur-xl
                      transition duration-300 transform hover:-translate-y-1 hover:shadow-lg hover:shadow-white/20">
                Kembali
            </a>

            <button type="submit"
                class="px-5 py-3 bg-blue-600/60 hover:bg-blue-600/80 border border-white/20 rounded-xl font-semibold backdrop-blur-xl w-full sm:w-auto
                       transition duration-300 transform hover:-translate-y-1 hover:shadow-lg hover:shadow-blue-500/30">
                Simpan Perubahan
            </button>
        </div>

    </form>
</div>

@endsection
