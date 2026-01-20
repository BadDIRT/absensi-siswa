@extends('layouts.editMain')

@section('title', 'ABSENSIKU - Edit Siswa')

@section('header')
<header class="sticky top-0 z-40 w-full bg-white/10 backdrop-blur-2xl border-b border-white/10 shadow-xl p-3 sm:p-4 flex items-center justify-between rounded-2xl">
    <div class="flex items-center gap-3">
        <button 
            @click="sidebarOpen = !sidebarOpen" 
            class="text-white text-2xl font-bold transform transition duration-300 hover:scale-125 hover:text-blue-300">
            ☰
        </button>
        <h1 class="text-xl sm:text-2xl font-bold drop-shadow">Edit Data Siswa/i</h1>
    </div>
</header>
@endsection

@section('content')

<div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-3xl shadow-2xl p-6 sm:p-8 
            transition-all duration-500 hover:shadow-blue-500/30 hover:shadow-2xl hover:-translate-y-1">

    <h2 class="text-lg sm:text-2xl font-bold mb-6">Form Edit Siswa/i</h2>

    <form method="POST" action="{{ route('students.update', $student->id) }}" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- NAMA --}}
        <div>
            <label class="font-semibold text-sm">Nama Lengkap</label>
            <input type="text" name="name"
                   value="{{ old('name', $student->name) }}"
                   class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl text-white
                          transition duration-300 hover:bg-white/20 focus:bg-white/30 focus:ring-2 focus:ring-blue-400">

            @error('name')
                <p class="mt-2 text-red-400 drop-shadow text-sm font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- JENIS KELAMIN --}}
        <div>
            <label class="font-semibold text-sm">Jenis Kelamin</label>
            <select name="gender"
                class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl text-white
                       transition duration-300 hover:bg-white/20 focus:bg-white/30 focus:ring-2 focus:ring-blue-400">
                <option class="text-black" value="L" {{ old('gender', $student->gender) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option class="text-black" value="P" {{ old('gender', $student->gender) == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>

            @error('gender')
                <p class="mt-2 text-red-400 drop-shadow text-sm font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- TANGGAL LAHIR --}}
        <div>
            <label class="font-semibold text-sm">Tanggal Lahir</label>
            <input type="date" name="date_of_birth"
                   value="{{ old('date_of_birth', $student->date_of_birth) }}"
                   class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl text-white
                          transition duration-300 hover:bg-white/20 focus:bg-white/30 focus:ring-2 focus:ring-blue-400">

            @error('date_of_birth')
                <p class="mt-2 text-red-400 drop-shadow text-sm font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- NISN --}}
        <div>
            <label class="font-semibold text-sm">NISN</label>
            <input type="text" name="nisn"
                   value="{{ old('nisn', $student->nisn) }}"
                   class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl text-white
                          transition duration-300 hover:bg-white/20 focus:bg-white/30 focus:ring-2 focus:ring-blue-400">

            @error('nisn')
                <p class="mt-2 text-red-400 drop-shadow text-sm font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- NIPD --}}
        <div>
            <label class="font-semibold text-sm">NIPD</label>
            <input type="text" name="nipd"
                   value="{{ old('nipd', $student->nipd) }}"
                   class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl text-white
                          transition duration-300 hover:bg-white/20 focus:bg-white/30 focus:ring-2 focus:ring-blue-400">

            @error('nipd')
                <p class="mt-2 text-red-400 drop-shadow text-sm font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- ALAMAT --}}
        <div>
            <label class="font-semibold text-sm">Alamat</label>
            <textarea name="address" rows="3"
                class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl text-white
                       transition duration-300 hover:bg-white/20 focus:bg-white/30 focus:ring-2 focus:ring-blue-400">{{ old('address', $student->address) }}</textarea>

            @error('address')
                <p class="mt-2 text-red-400 drop-shadow text-sm font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- KELAS --}}
        <div>
            <label class="font-semibold text-sm">Kelas</label>
            <select name="class_id"
                class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl text-white
                       transition duration-300 hover:bg-white/20 focus:bg-white/30 focus:ring-2 focus:ring-blue-400">
                @foreach ($classes as $c)
                    <option class="text-black" value="{{ $c->id }}"
                        {{ old('class_id', $student->class_id) == $c->id ? 'selected' : '' }}>
                        {{ $c->grade }}
                    </option>
                @endforeach
            </select>

            @error('class_id')
                <p class="mt-2 text-red-400 drop-shadow text-sm font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- JURUSAN --}}
        <div>
            <label class="font-semibold text-sm">Jurusan</label>
            <select name="department_id"
                class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl text-white
                       transition duration-300 hover:bg-white/20 focus:bg-white/30 focus:ring-2 focus:ring-blue-400">
                @foreach ($departments as $d)
                    <option class="text-black" value="{{ $d->id }}"
                        {{ old('department_id', $student->department_id) == $d->id ? 'selected' : '' }}>
                        {{ $d->name }}
                    </option>
                @endforeach
            </select>

            @error('department_id')
                <p class="mt-2 text-red-400 drop-shadow text-sm font-semibold">{{ $message }}</p>
            @enderror
        </div>

        {{-- BUTTONS --}}
        <div class="flex flex-col sm:flex-row gap-3 pt-4">

            <a href="{{ route('students.index') }}"
                class="px-5 py-3 bg-white/20 hover:bg-white/30 border border-white/30 rounded-xl font-semibold text-center backdrop-blur-xl
                      transition duration-300 transform hover:-translate-y-1 hover:shadow-lg hover:shadow-white/20">
                Kembali
            </a>

            <button type="submit"
                class="px-5 py-3 bg-blue-600/60 hover:bg-blue-600/80 border border-white/20 rounded-xl font-semibold backdrop-blur-xl w-full sm:w-auto
                       transition duration-300 transform hover:-translate-y-1 hover:shadow-lg hover:shadow-blue-500/30">
                Update Data
            </button>

        </div>

    </form>
</div>

@endsection
