@extends('layouts.indexMain')

@section('headerTitle', 'ABSENSIKU - Scan Barcode')
@section('pageTitle', 'Scan Kehadiran')

@section('content')

<div class="max-w-xl mx-auto bg-white/10 backdrop-blur-2xl border border-white/10 rounded-3xl p-8 shadow-2xl">

    <h2 class="text-2xl font-bold mb-6 text-center">Scan Kode Batang</h2>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-500/30 rounded-xl text-center font-semibold">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-3 bg-red-500/30 rounded-xl text-center font-semibold">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('attendance.scan.process') }}">
        @csrf

        <label class="font-semibold text-sm">NIPD (hasil scan)</label>
        <input
            type="text"
            name="nipd"
            autofocus
            placeholder="Scan barcode di sini"
            class="w-full mt-3 p-4 rounded-xl bg-white/5 border border-white/20 text-white
                   focus:ring-2 focus:ring-blue-400 focus:outline-none"
        >

        <button
            type="submit"
            class="mt-6 w-full py-3 bg-blue-600/60 hover:bg-blue-600/80 rounded-xl font-semibold transition">
            Proses Absensi
        </button>
    </form>

    <p class="text-xs text-white/60 text-center mt-6">
        Scan 1x = Masuk | Scan 2x = Pulang | Scan lebih dari 2x akan ditolak
    </p>

</div>

@endsection
