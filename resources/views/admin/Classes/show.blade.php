<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false, confirmDelete: false }">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ABSENSIKU - Detail Kelas</title>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.1/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex flex-col @include('layouts.bgColor') text-white">
<div class="flex flex-1">

    <!-- OVERLAY -->
    <div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false"
         class="fixed inset-0 bg-black/40 backdrop-blur-md z-40"></div>

    <!-- SIDEBAR -->
    @include('layouts.sidebar')

    <div class="p-4 sm:p-6 w-full">

        <!-- LOGO -->
        <div class="flex items-center gap-3 mb-4 sm:mb-6">
            <img src="/images/absensiku-logo.png" class="w-10 h-10 drop-shadow-xl">
            <h2 class="text-2xl font-bold drop-shadow">ABSENSIKU</h2>
        </div>

        @include('layouts.sidebarMenu')

        <div class="flex-1 flex flex-col transition-all duration-300">

            <!-- HEADER -->
            <header 
                class="sticky top-0 z-40 w-full bg-white/10 backdrop-blur-2xl border-b border-white/10 shadow-xl 
                       p-3 sm:p-4 flex items-center justify-between rounded-2xl">
                <div class="flex items-center gap-3">
                    <button 
                        @click="sidebarOpen = !sidebarOpen" 
                        class="text-white text-2xl font-bold transform transition duration-300 hover:scale-125 hover:text-blue-300"
                    >
                        ☰
                    </button>
                    <h1 class="text-xl sm:text-2xl font-bold drop-shadow">Detail Kelas</h1>
                </div>
            </header>

            <main 
                class="p-2 sm:p-6 space-y-6 flex-1 mt-4"
                x-transition:enter="ease-out duration-500"
                x-transition:enter-start="opacity-0 translate-y-3"
                x-transition:enter-end="opacity-100 translate-y-0"
            >

                <div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-3xl shadow-2xl p-6 sm:p-8 
                            transition-all duration-500 hover:shadow-blue-500/30 hover:shadow-2xl max-w-2xl mx-auto">

                    <h2 class="text-lg sm:text-2xl font-bold mb-6">Informasi Kelas</h2>

                    <div class="grid sm:grid-cols-2 gap-6 text-white">

                        <div class="bg-white/5 p-4 rounded-2xl border border-white/10">
                            <p class="text-sm opacity-80">Tingkat Kelas (Grade)</p>
                            <p class="text-xl font-bold mt-1">{{ $class->grade }}</p>
                        </div>

                        <div class="bg-white/5 p-4 rounded-2xl border border-white/10">
                            <p class="text-sm opacity-80">Jurusan</p>
                            <p class="text-xl font-bold mt-1">{{ $class->department->name ?? '-' }}</p>
                        </div>

                        <div class="bg-white/5 p-4 rounded-2xl border border-white/10">
                            <p class="text-sm opacity-80">Wali Kelas</p>
                            <p class="text-xl font-bold mt-1">{{ $class->teacher->name ?? '-' }}</p>
                        </div>

                        <div class="bg-white/5 p-4 rounded-2xl border border-white/10">
                            <p class="text-sm opacity-80">Jumlah Siswa</p>
                            <p class="text-xl font-bold mt-1">{{ $class->students->count() }} siswa</p>
                        </div>

                    </div>

                    <!-- TIMESTAMP -->
                    <div class="mt-8 p-4 bg-white/10 border border-white/20 rounded-xl shadow-inner">
                        <p class="text-sm">
                            <span class="font-semibold">📅 Dibuat pada:</span>
                            {{ $class->created_at->translatedFormat('d F Y, H:i') }}
                        </p>
                        <p class="text-sm mt-1">
                            <span class="font-semibold">🕒 Terakhir diperbarui:</span>
                            {{ $class->updated_at->translatedFormat('d F Y, H:i') }}
                        </p>
                    </div>

                    <!-- BUTTONS -->
                    <div class="flex flex-col sm:flex-row gap-3 mt-8">

                        <a href="{{ route('classes.index') }}"
                            class="px-5 py-3 bg-white/20 hover:bg-white/30 border border-white/30 rounded-xl font-semibold text-center backdrop-blur-xl
                                   transition duration-300 transform hover:-translate-y-1 hover:shadow-lg hover:shadow-white/20">
                            Kembali
                        </a>

                        <a href="{{ route('classes.edit', $class->id) }}"
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

            </main>

            @include('layouts.footer')

        </div>

    </div>

</div>

<!-- DELETE MODAL -->
<div 
    x-show="confirmDelete"
    x-transition.opacity
    class="fixed inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm z-[999]"
>
    <div 
        x-transition.scale
        class="bg-white/10 border border-white/20 rounded-3xl p-6 w-80 backdrop-blur-xl shadow-2xl"
    >
        <h2 class="text-xl font-bold mb-4">Hapus Kelas?</h2>
        <p class="text-sm mb-6 opacity-80">Tindakan ini tidak dapat dibatalkan.</p>

        <div class="flex gap-3">
            <button 
                @click="confirmDelete = false"
                class="px-4 py-2 w-full bg-white/20 hover:bg-white/30 border border-white/30 rounded-xl">
                Batal
            </button>

            <form action="{{ route('classes.destroy', $class->id) }}" method="POST" class="w-full">
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

</body>
</html>
