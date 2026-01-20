@extends('layouts.editMain')

@section('title', 'ABSENSIKU - Buat Kode Batang')

@section('header')
<header class="sticky top-0 z-40 w-full bg-white/10 backdrop-blur-2xl border-b border-white/10 shadow-xl p-3 sm:p-4 flex items-center justify-between rounded-2xl">
    <div class="flex items-center gap-3">
        <button @click="sidebarOpen = !sidebarOpen"
            class="text-white text-2xl font-bold transform transition hover:scale-125 hover:text-blue-300">
            ☰
        </button>
        <h1 class="text-xl sm:text-2xl font-bold">Buat Kode Batang Siswa</h1>
    </div>
</header>
@endsection

@section('content')

<div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-3xl shadow-2xl p-6 sm:p-8">

    <h2 class="text-lg sm:text-2xl font-bold mb-6">Input NIPD</h2>

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-500/30 rounded-xl">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.students.barcode.store') }}" method="POST" class="space-y-5">
    @csrf

    <div>
        <label class="font-semibold text-sm">NIPD</label>
        <input type="text" name="nipd"
            class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl text-white
                   focus:ring-2 focus:ring-blue-400"
            value="{{ old('nipd') }}">

        @error('nipd')
            <p class="mt-2 text-red-400 text-sm font-semibold">{{ $message }}</p>
        @enderror
    </div>

        <div class="flex gap-3 pt-4">
            <a href="{{ route('admin.students.index') }}"
                class="px-5 py-3 bg-white/20 rounded-xl font-semibold text-center">
                Kembali
            </a>

            <button type="submit"
                class="px-5 py-3 bg-blue-600/60 rounded-xl font-semibold">
                Buat Kode Batang
            </button>
        </div>

    </form>
</div>

@endsection
