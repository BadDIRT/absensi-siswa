<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ABSENSIKU - Tambah Guru</title>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.1/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex flex-col @include('layouts.bgColor') text-white">
<div class="flex flex-1">

    <!-- OVERLAY -->
    <div 
        x-show="sidebarOpen"
        x-transition.opacity
        @click="sidebarOpen = false"
        class="fixed inset-0 bg-black/40 backdrop-blur-md z-40">
    </div>

    <!-- SIDEBAR -->
    @include('layouts.sidebar')

    <div class="p-4 sm:p-6 w-full">

        <!-- LOGO -->
        <div class="flex items-center gap-3 mb-4 sm:mb-6">
            <img src="/images/absensiku-logo.png" class="w-10 h-10 drop-shadow-xl">
            <h2 class="text-2xl font-bold drop-shadow">ABSENSIKU</h2>
        </div>

        <!-- MENU -->
        @include('layouts.sidebarMenu')

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
                    <h1 class="text-xl sm:text-2xl font-bold drop-shadow">Tambah Guru</h1>
                </div>

            </header>

            <!-- MAIN FORM -->
            <main class="p-2 sm:p-6 space-y-6 flex-1 mt-4">

                <div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-3xl shadow-2xl 
                            p-6 sm:p-8 transition-all duration-500 hover:shadow-blue-500/30 hover:-translate-y-1 max-w-3xl mx-auto">

                    <h2 class="text-lg sm:text-2xl font-bold mb-6">Form Tambah Guru</h2>

                    <form method="POST" action="{{ route('teachers.store') }}" class="space-y-5">
                        @csrf

                        <!-- NAMA -->
                        <div>
                            <label class="font-semibold text-sm">Nama Guru</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   placeholder="Masukkan nama lengkap"
                                   class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl 
                                   text-white placeholder-white/50
                                   transition duration-300 hover:bg-white/20 focus:bg-white/30 focus:ring-2 focus:ring-blue-400">

                            @error('name')
                                <p class="mt-2 text-red-400 text-sm font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- NIP + TELEPON -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="font-semibold text-sm">NIP</label>
                                <input type="text" name="nip" value="{{ old('nip') }}"
                                       placeholder="Masukkan NIP"
                                       class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl 
                                       text-white placeholder-white/50
                                       transition duration-300 hover:bg-white/20 focus:bg-white/30 focus:ring-2 focus:ring-blue-400">

                                @error('nip')
                                    <p class="mt-2 text-red-400 text-sm font-semibold">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="font-semibold text-sm">No Telepon</label>
                                <input type="text" name="phone_number" value="{{ old('phone_number') }}"
                                       placeholder="Masukkan No telepon"
                                       class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl 
                                       text-white placeholder-white/50
                                       transition duration-300 hover:bg-white/20 focus:bg-white/30 focus:ring-2 focus:ring-blue-400">

                                @error('phone_number')
                                    <p class="mt-2 text-red-400 text-sm font-semibold">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- GENDER -->
                        <div>
                            <label class="font-semibold text-sm">Jenis Kelamin</label>
                            <select name="gender"
                                class="w-full mt-2 p-3 rounded-xl bg-white/5 border border-white/20 backdrop-blur-xl text-white
                                       transition duration-300 hover:bg-white/20 focus:bg-white/30 focus:ring-2 focus:ring-blue-400">
                                <option class="text-black" value="">-- Pilih Jenis Kelamin --</option>
                                <option class="text-black" value="L" {{ old('gender')=='L' ? 'selected' : '' }}>Laki-laki</option>
                                <option class="text-black" value="P" {{ old('gender')=='P' ? 'selected' : '' }}>Perempuan</option>
                            </select>

                            @error('gender')
                                <p class="mt-2 text-red-400 text-sm font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- BUTTON -->
                        <div class="flex flex-col sm:flex-row gap-3 pt-4">

                            <a href="{{ route('teachers.index') }}"
                               class="px-5 py-3 bg-white/20 hover:bg-white/30 border border-white/30 rounded-xl font-semibold text-center backdrop-blur-xl
                                      transition duration-300 transform hover:-translate-y-1 hover:shadow-lg hover:shadow-white/20">
                                Kembali
                            </a>

                            <button type="submit"
                                    class="px-5 py-3 bg-blue-600/60 hover:bg-blue-600/80 border border-white/20 rounded-xl font-semibold backdrop-blur-xl w-full sm:w-auto
                                           transition duration-300 transform hover:-translate-y-1 hover:shadow-lg hover:shadow-blue-500/30">
                                Simpan Data Guru
                            </button>

                        </div>

                    </form>
                </div>

            </main>

            @include('layouts.footer')
        </div>
    </div>

</div>
</body>
</html>
