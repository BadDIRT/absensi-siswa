@extends('layouts.editMain')

@section('title', 'ABSENSIKU - Edit Jurusan')

@section('header')
<header class="sticky top-0 z-40 w-full bg-white/10 backdrop-blur-2xl border-b border-white/10 shadow-xl p-3 sm:p-4 flex items-center justify-between rounded-2xl">
    <div class="flex items-center gap-3">
        <button 
            @click="sidebarOpen = !sidebarOpen" 
            class="text-white text-2xl font-bold transform transition duration-300 hover:scale-125 hover:text-blue-300"
        >
            ☰
        </button>
        <h1 class="text-xl sm:text-2xl font-bold drop-shadow">Edit Data Jurusan</h1>
    </div>
</header>
@endsection

@section('content')

<div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-3xl shadow-2xl p-6 sm:p-8 
            transition-all duration-500 hover:shadow-blue-500/30 hover:shadow-2xl hover:-translate-y-1">

    <h2 class="text-lg sm:text-2xl font-bold mb-6">Form Edit Jurusan</h2>

    <form action="{{ route('departments.update', $department->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- NAMA JURUSAN --}}
        <div>
            <label class="font-semibold text-sm">Nama Jurusan</label>
            <input 
                type="text" 
                name="name"
                value="{{ old('name', $department->name) }}"
                class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl text-white
                       placeholder-white/60 transition duration-300 hover:bg-white/20 focus:bg-white/30 
                       focus:ring-2 focus:ring-blue-400">

            @error('name')
                <p class="mt-2 text-red-400 drop-shadow text-sm font-semibold">
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- KODE JURUSAN --}}
        <div>
            <label class="font-semibold text-sm">Kode Jurusan</label>
            <input 
                type="text" 
                name="code"
                value="{{ old('code', $department->code) }}"
                class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl text-white
                       placeholder-white/60 transition duration-300 hover:bg-white/20 focus:bg-white/30 
                       focus:ring-2 focus:ring-blue-400">

            @error('code')
                <p class="mt-2 text-red-400 drop-shadow text-sm font-semibold">
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- DESKRIPSI --}}
        <div>
            <label class="font-semibold text-sm">Deskripsi Jurusan</label>
            <textarea 
                name="description" 
                rows="4"
                class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl text-white
                       placeholder-white/60 transition duration-300 hover:bg-white/20 focus:bg-white/30 
                       focus:ring-2 focus:ring-blue-400">{{ old('description', $department->description) }}</textarea>

            @error('description')
                <p class="mt-2 text-red-400 drop-shadow text-sm font-semibold">
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- BUTTONS --}}
        <div class="flex flex-col sm:flex-row gap-3 pt-4">

            <a href="{{ route('departments.index') }}"
                class="px-5 py-3 bg-white/20 hover:bg-white/30 border border-white/30 rounded-xl font-semibold text-center backdrop-blur-xl
                       transition duration-300 transform hover:-translate-y-1 hover:shadow-lg hover:shadow-white/20">
                Kembali
            </a>

            <button type="submit"
                class="px-5 py-3 bg-blue-600/60 hover:bg-blue-600/80 border border-white/20 rounded-xl font-semibold backdrop-blur-xl
                       transition duration-300 transform hover:-translate-y-1 hover:shadow-lg hover:shadow-blue-500/30">
                Simpan Perubahan
            </button>

        </div>

    </form>
</div>

@endsection
