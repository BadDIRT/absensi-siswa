<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ABSENSIKU - Data Jurusan</title>

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

        <!-- LOGO + BRAND -->
        <div class="flex items-center gap-3 mb-4 sm:mb-6">
            <img src="/images/absensiku-logo.png" class="w-10 h-10 drop-shadow-xl">
            <h2 class="text-2xl font-bold drop-shadow">ABSENSIKU</h2>
        </div>

        <!-- MENU -->
        @include('layouts.sidebarMenu')

        <div class="flex-1 flex flex-col transition-all duration-300">

            <!-- HEADER SAMA PERSIS TIMETABLE -->
            <header class="sticky top-0 z-40 w-full bg-white/10 backdrop-blur-2xl border-b border-white/10 shadow-xl
                           p-3 sm:p-4 flex flex-wrap gap-3 items-center justify-between rounded-2xl">

                <div class="flex items-center gap-3 w-full sm:w-auto justify-between">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-white text-2xl font-bold">☰</button>

                    <div class="flex items-center gap-3">
                        <img src="/images/absensiku-logo.png" class="hidden lg:block w-10 h-10 drop-shadow-xl">
                        <h1 class="text-xl sm:text-2xl font-bold drop-shadow">Data Jurusan</h1>
                    </div>
                </div>

                <a href="{{ route('departments.create') }}"
                   class="px-4 py-2 bg-white/10 backdrop-blur-2xl hover:bg-white/20 border border-white/20
                          hover:scale-105 hover:shadow-lg text-white rounded-xl transition-all duration-300
                          font-semibold w-full sm:w-auto text-center">
                    + Tambah Jurusan
                </a>
            </header>

            <!-- ALERT -->
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show"
                     x-init="setTimeout(() => show = false, 3000)" x-transition
                     class="mx-2 sm:mx-6 mt-4 flex items-center justify-between bg-green-500/20 backdrop-blur-xl
                     text-white font-semibold px-4 sm:px-6 py-3 rounded-xl shadow-xl border border-white/20">

                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12l2 2l4-4m5 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="hover:text-white/80 transition">✕</button>
                </div>
            @endif

            <main class="p-2 sm:p-6 space-y-4 sm:space-y-8 flex-1 mt-4">

                <div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-3xl shadow-2xl
                            p-4 sm:p-6 overflow-x-auto">

                    <h2 class="text-lg sm:text-xl font-bold mb-4 drop-shadow">Daftar Jurusan</h2>

                    <!-- DESKTOP TABLE -->
                    <table class="w-full min-w-[900px] text-white text-xs sm:text-base hidden md:table">
                        <thead>
                            <tr class="bg-white/10 border-b border-white/20">
                                <th class="p-3">No</th>
                                <th class="p-3">Nama Jurusan</th>
                                <th class="p-3">Kode</th>
                                <th class="p-3">Deskripsi</th>
                                <th class="p-3 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                        @forelse($departments as $d)
                            <tr class="border-b border-white/10 hover:bg-white/10 transition-all duration-300">
                                <td class="p-3">{{ $loop->iteration }}</td>
                                <td class="p-3 font-semibold">{{ $d->name }}</td>
                                <td class="p-3">{{ $d->code ?? '-' }}</td>
                                <td class="p-3">{{ $d->description ?? '-' }}</td>

                                <td class="p-3 text-center">
                                    <div class="flex gap-2 justify-center">

                                        <a href="{{ route('departments.show', $d->id) }}"
                                           class="px-3 py-1 bg-blue-500/40 hover:bg-blue-500/60 backdrop-blur-xl
                                           border border-white/20 rounded-lg font-semibold transition">
                                            Detail
                                        </a>

                                        <a href="{{ route('departments.edit', $d->id) }}"
                                           class="px-3 py-1 bg-yellow-500/40 hover:bg-yellow-500/60 backdrop-blur-xl
                                           border border-white/20 rounded-lg font-semibold transition">
                                            Edit
                                        </a>

                                        <form action="{{ route('departments.destroy', $d->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus data jurusan ini?')">
                                            @csrf @method('DELETE')
                                            <button
                                                class="px-3 py-1 bg-red-500/40 hover:bg-red-500/60 backdrop-blur-xl
                                                border border-white/20 rounded-lg font-semibold transition">
                                                Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-white/60">Belum ada data jurusan.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <!-- MOBILE CARDS — SAMA PERSIS STYLE TIMETABLE -->
                    <div class="block md:hidden space-y-4 mt-4">
                        @forelse($departments as $d)
                            <div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-2xl
                                        p-4 sm:p-5 shadow-2xl">

                                <h3 class="text-lg sm:text-xl font-bold">{{ $d->name }}</h3>
                                <p class="text-white/70 text-sm mt-1">Kode: {{ $d->code ?? '-' }}</p>

                                <div class="mt-4 bg-white/5 p-3 rounded-xl text-sm">
                                    <span class="text-xs opacity-70">Deskripsi</span>
                                    <p class="font-semibold">{{ $d->description ?? '-' }}</p>
                                </div>

                                <div class="mt-5 grid grid-cols-1 gap-3">

                                    <a href="{{ route('departments.show', $d->id) }}"
                                       class="px-4 py-3 bg-blue-500/40 backdrop-blur-xl border border-white/20
                                       rounded-xl font-semibold text-center">
                                        Detail
                                    </a>

                                    <a href="{{ route('departments.edit', $d->id) }}"
                                       class="px-4 py-3 bg-yellow-500/40 backdrop-blur-xl border border-white/20
                                       rounded-xl font-semibold text-center">
                                        Edit
                                    </a>

                                    <form action="{{ route('departments.destroy', $d->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus data jurusan ini?')">
                                        @csrf @method('DELETE')
                                        <button
                                            class="px-4 py-3 bg-red-500/40 backdrop-blur-xl border border-white/20
                                            rounded-xl font-semibold w-full">
                                            Hapus
                                        </button>
                                    </form>

                                </div>

                            </div>
                        @empty
                            <p class="text-center text-white/70">Belum ada data jurusan.</p>
                        @endforelse
                    </div>

                </div>
            </main>

            @include('layouts.footer')
        </div>
    </div>

</div>
</body>
</html>
