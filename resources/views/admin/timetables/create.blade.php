<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ABSENSIKU - Tambah Jadwal</title>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.1/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex flex-col @include('layouts.components._bgColor') text-white">
<div class="flex flex-1">

    <!-- OVERLAY -->
    <div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false"
         class="fixed inset-0 bg-black/40 backdrop-blur-md z-40"></div>

    <!-- SIDEBAR -->
    @include('layouts.components._sidebar')

    <div class="p-4 sm:p-6 w-full">

        <!-- LOGO -->
        <div class="flex items-center gap-3 mb-4 sm:mb-6">
            <img src="/images/absensiku-logo.png" class="w-10 h-10 drop-shadow-xl">
            <h2 class="text-2xl font-bold drop-shadow">ABSENSIKU</h2>
        </div>

        <!-- MENU -->
        @include('layouts.components._sidebarMenu')

        <div class="flex-1 flex flex-col transition-all duration-300">

            <!-- HEADER -->
            <header class="sticky top-0 z-40 w-full bg-white/10 backdrop-blur-2xl border-b border-white/10 shadow-xl p-3 sm:p-4 flex items-center justify-between rounded-2xl">
                <div class="flex items-center gap-3">
                    <button 
                        @click="sidebarOpen = !sidebarOpen" 
                        class="text-white text-2xl font-bold transform transition duration-300 hover:scale-125 hover:text-blue-300"
                    >
                        ☰
                    </button>
                    <h1 class="text-xl sm:text-2xl font-bold drop-shadow">Tambah Jadwal Pelajaran</h1>
                </div>
            </header>

            <main class="p-2 sm:p-6 space-y-6 flex-1 mt-4">

                <div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-3xl shadow-2xl p-6 sm:p-8 
                            transition-all duration-500 hover:shadow-blue-500/30 hover:shadow-2xl hover:-translate-y-1">

                    <h2 class="text-lg sm:text-2xl font-bold mb-6">Form Tambah Jadwal</h2>

                    <form action="{{ route('timetables.store') }}" method="POST" class="space-y-5">
                        @csrf

                        <!-- HARI -->
                        <div>
                            <label class="font-semibold text-sm">Hari</label>
                            <select name="day"
                                class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl text-white
                                       transition duration-300 hover:bg-white/20 focus:bg-white/30 focus:ring-2 focus:ring-blue-400">
                                <option class="text-black" value="">-- Pilih Hari --</option>
                                @foreach (['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari)
                                    <option class="text-black"
                                        value="{{ $hari }}"
                                        {{ old('day') == $hari ? 'selected' : '' }}
                                    >{{ $hari }}</option>
                                @endforeach
                            </select>

                            @error('day')
                                <p class="mt-2 text-red-400 drop-shadow-[0_0_6px_rgba(255,0,0,0.8)] text-sm font-semibold"
                                   x-transition.opacity>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- MATA PELAJARAN -->
                        <div>
                            <label class="font-semibold text-sm">Mata Pelajaran</label>
                            <select name="subject_id"
                                class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl text-white
                                       transition duration-300 hover:bg-white/20 focus:bg-white/30 focus:ring-2 focus:ring-blue-400">
                                <option value="">-- Pilih Mapel --</option>
                                @foreach ($subjects as $s)
                                    <option class="text-black" value="{{ $s->id }}"
                                        {{ old('subject_id') == $s->id ? 'selected' : '' }}>
                                        {{ $s->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('subject_id')
                                <p class="mt-2 text-red-400 drop-shadow-[0_0_6px_rgba(255,0,0,0.8)] text-sm font-semibold"
                                   x-transition.opacity>
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
                                <option value="">-- Pilih Guru --</option>
                                @foreach ($teachers as $t)
                                    <option class="text-black" value="{{ $t->id }}"
                                        {{ old('teacher_id') == $t->id ? 'selected' : '' }}>
                                        {{ $t->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('teacher_id')
                                <p class="mt-2 text-red-400 drop-shadow-[0_0_6px_rgba(255,0,0,0.8)] text-sm font-semibold"
                                   x-transition.opacity>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- KELAS -->
                        <div>
                            <label class="font-semibold text-sm">Kelas</label>
                            <select name="class_id"
                                class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl text-white
                                       transition duration-300 hover:bg-white/20 focus:bg-white/30 focus:ring-2 focus:ring-blue-400">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach ($classes as $c)
                                    <option class="text-black" value="{{ $c->id }}"
                                        {{ old('class_id') == $c->id ? 'selected' : '' }}>
                                        {{ $c->grade }}
                                    </option>
                                @endforeach
                            </select>

                            @error('class_id')
                                <p class="mt-2 text-red-400 drop-shadow-[0_0_6px_rgba(255,0,0,0.8)] text-sm font-semibold"
                                   x-transition.opacity>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- JAM MULAI -->
                        <div>
                            <label class="font-semibold text-sm">Jam Mulai</label>
                            <input type="time" name="start_time"
                                   value="{{ old('start_time') }}"
                                   class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl text-white
                                          transition duration-300 hover:bg-white/20 focus:bg-white/30 focus:ring-2 focus:ring-blue-400">

                            @error('start_time')
                                <p class="mt-2 text-red-400 drop-shadow-[0_0_6px_rgba(255,0,0,0.8)] text-sm font-semibold"
                                   x-transition.opacity>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- JAM SELESAI -->
                        <div>
                            <label class="font-semibold text-sm">Jam Selesai</label>
                            <input type="time" name="end_time"
                                   value="{{ old('end_time') }}"
                                   class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl text-white
                                          transition duration-300 hover:bg-white/20 focus:bg-white/30 focus:ring-2 focus:ring-blue-400">

                            @error('end_time')
                                <p class="mt-2 text-red-400 drop-shadow-[0_0_6px_rgba(255,0,0,0.8)] text-sm font-semibold"
                                   x-transition.opacity>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- BUTTONS -->
                        <div class="flex flex-col sm:flex-row gap-3 pt-4">

                            <a href="{{ route('timetables.index') }}"
                               class="px-5 py-3 bg-white/20 hover:bg-white/30 border border-white/30 rounded-xl font-semibold text-center backdrop-blur-xl
                                      transition duration-300 transform hover:-translate-y-1 hover:shadow-lg hover:shadow-white/20">
                                Kembali
                            </a>

                            <button type="submit"
                                    class="px-5 py-3 bg-blue-600/60 hover:bg-blue-600/80 border border-white/20 rounded-xl font-semibold backdrop-blur-xl w-full sm:w-auto
                                           transition duration-300 transform hover:-translate-y-1 hover:shadow-lg hover:shadow-blue-500/30">
                                Simpan Jadwal
                            </button>
                        </div>

                    </form>
                </div>

            </main>

            @include('layouts.components._footer')

        </div>

    </div>

</div>
</body>
</html>
