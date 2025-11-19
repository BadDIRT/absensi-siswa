<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ABSENSIKU - Jadwal Pelajaran</title>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.1/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex flex-col @include('layouts.components._bgColor') text-white">
<div class="flex flex-1">

    <!-- OVERLAY -->
    @include('layouts.components._overlay')

    <!-- SIDEBAR -->
    @include('layouts.components._sidebar')

    <div class="p-4 sm:p-6 w-full">

    <!-- LOGO + BRAND -->
    @include('layouts.components._logo')

    <!-- MENU -->
    @include('layouts.components._sidebarMenu')

        <div class="flex-1 flex flex-col transition-all duration-300">

            <!-- HEADER EXTREME RESPONSIVE -->
            <header class="sticky top-0 z-40 w-full bg-white/10 backdrop-blur-2xl border-b border-white/10 shadow-xl p-3 sm:p-4 flex flex-wrap gap-3 items-center justify-between rounded-2xl">
                <div class="flex items-center gap-3 w-full sm:w-auto justify-between">
                    <div class="flex items-center gap-3">
                        <button @click="sidebarOpen = !sidebarOpen" 
                        class="text-white text-2xl font-bold transform transition duration-300 hover:scale-125 hover:text-blue-300">☰</button>
                        <img src="/images/absensiku-logo.png" class="hidden lg:block w-10 h-10 drop-shadow-xl">
                        <h1 class="text-xl sm:text-2xl font-bold drop-shadow">Jadwal Pelajaran</h1>
                    </div>
                </div>

                <a href="{{ route('timetables.create') }}"
                   class="px-4 py-2 bg-white/10 backdrop-blur-2xl hover:bg-white/20 border border-white/20 hover:scale-105 hover:shadow-lg text-white rounded-xl transition-all duration-300 font-semibold w-full sm:w-auto text-center">
                    + Tambah Jadwal
                </a>
            </header>

            <!-- ALERT -->
            @include('layouts.components._alertMessage')

            <main class="p-2 sm:p-6 space-y-4 sm:space-y-8 flex-1 mt-4">

                <div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-3xl shadow-2xl p-4 sm:p-6 overflow-x-auto">
                    
                    <form method="GET"
      x-data="{ openFilter: false }"
      class="mb-6 bg-white/10 backdrop-blur-2xl border border-white/20 rounded-2xl p-4 sm:p-5 shadow-xl space-y-4 transition">

    <!-- SEARCH BAR -->
    @include('layouts.components._searchBar')

    <!-- FILTER TOGGLE BUTTON -->
    @include('layouts.components._filterToggleButton')

    <!-- FILTER PANEL -->
<div x-show="openFilter"
     x-transition.duration.400ms
     class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">

    <!-- Filter Field -->
    <div class="flex flex-col gap-1">
        <label class="text-sm text-white/70">Filter Berdasarkan</label>
        <select name="filter_field"
                class="px-4 py-3 rounded-xl bg-white/20 backdrop-blur-xl text-white border border-white/30
                       focus:ring-2 focus:ring-white/40 transition">
            <option value="">— Pilih Filter —</option>
            <option value="day" {{ request('filter_field') == 'day' ? 'selected' : '' }}>Hari</option>
            <option value="teacher" {{ request('filter_field') == 'teacher' ? 'selected' : '' }}>Guru</option>
            <option value="class" {{ request('filter_field') == 'class' ? 'selected' : '' }}>Kelas</option>
            <option value="start_time" {{ request('filter_field') == 'start_time' ? 'selected' : '' }}>Jam Mulai</option>
            <option value="end_time" {{ request('filter_field') == 'end_time' ? 'selected' : '' }}>Jam Selesai</option>
        </select>
    </div>

    <!-- Filter Value -->
    @include('layouts.components._filterValue')

    <!-- SORTING -->
    @include('layouts.components._sorting')

</div>


    <!-- SUBMIT BUTTON -->
    @include('layouts.components._submitButton')

</form>



                    <h2 class="text-lg sm:text-xl font-bold mb-4 drop-shadow">Daftar Jadwal Pelajaran</h2>

                    <!-- DESKTOP TABLE -->
                    <table class="w-full min-w-[900px] text-white text-xs sm:text-base hidden md:table">
                        <thead>
                            <tr class="bg-white/10 border-b border-white/20">
                                <th class="p-3">No</th>
                                <th class="p-3">Hari</th>
                                <th class="p-3">Mata Pelajaran</th>
                                <th class="p-3">Guru</th>
                                <th class="p-3">Jam Mulai</th>
                                <th class="p-3">Jam Selesai</th>
                                <th class="p-3">Kelas</th>
                                <th class="p-3 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                        @forelse($timetables as $t)
                            <tr class="border-b border-white/10 hover:bg-white/10 transition-all duration-300">
                                <td class="p-3">{{ $loop->iteration }}</td>
                                <td class="p-3">{{ $t->day }}</td>
                                <td class="p-3">{{ $t->subject->name }}</td>
                                <td class="p-3">{{ $t->teacher->name }}</td>
                                <td class="p-3">{{ $t->start_time }}</td>
                                <td class="p-3">{{ $t->end_time }}</td>
                                <td class="p-3">{{ $t->class->grade }}</td>

                                <td class="p-3 text-center">
                                    <div class="flex gap-2 justify-center">
                                        <a href="{{ route('timetables.show', $t->id) }}"
                                           class="px-3 py-1 bg-blue-500/40 hover:bg-blue-500/60 backdrop-blur-xl border border-white/20 rounded-lg font-semibold transition">Detail</a>

                                        <a href="{{ route('timetables.edit', $t->id) }}"
                                           class="px-3 py-1 bg-yellow-500/40 hover:bg-yellow-500/60 backdrop-blur-xl border border-white/20 rounded-lg font-semibold transition">Edit</a>

                                        <form action="{{ route('timetables.destroy', $t->id) }}" method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                                            @csrf @method('DELETE')
                                            <button
                                                class="px-3 py-1 bg-red-500/40 hover:bg-red-500/60 backdrop-blur-xl border border-white/20 rounded-lg font-semibold transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-white/60">Belum ada jadwal.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <!-- EXTREME MOBILE CARDS -->
                    <div class="block md:hidden space-y-4 mt-4">
                        @forelse($timetables as $t)
                            <div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-2xl p-4 sm:p-5 shadow-2xl">

                                <div class="flex justify-between items-center">
                                    <h3 class="text-lg sm:text-xl font-bold">{{ $t->subject->name }}</h3>
                                    <span class="text-xs sm:text-sm bg-white/10 px-3 py-1 rounded-lg">{{ $t->day }}</span>
                                </div>

                                <div class="mt-4 grid grid-cols-2 gap-3 text-sm">
                                    <div class="flex flex-col bg-white/5 p-3 rounded-xl">
                                        <span class="text-xs opacity-70">👤 Guru</span>
                                        <span class="font-semibold">{{ $t->teacher->name }}</span>
                                    </div>

                                    <div class="flex flex-col bg-white/5 p-3 rounded-xl">
                                        <span class="text-xs opacity-70">🏫 Kelas</span>
                                        <span class="font-semibold">{{ $t->class->grade }}</span>
                                    </div>

                                    <div class="flex flex-col bg-white/5 p-3 rounded-xl col-span-2">
                                        <span class="text-xs opacity-70">🕒 Jam Pelajaran</span>
                                        <span class="font-semibold">{{ $t->start_time }} – {{ $t->end_time }}</span>
                                    </div>
                                </div>

                                <div class="mt-5 grid grid-cols-1 gap-3">
                                    <a href="{{ route('timetables.show', $t->id) }}"
                                       class="px-4 py-3 bg-blue-500/40 backdrop-blur-xl border border-white/20 rounded-xl font-semibold text-center">
                                        Detail
                                    </a>

                                    <a href="{{ route('timetables.edit', $t->id) }}"
                                       class="px-4 py-3 bg-yellow-500/40 backdrop-blur-xl border border-white/20 rounded-xl font-semibold text-center">
                                        Edit
                                    </a>

                                    <form action="{{ route('timetables.destroy', $t->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                                        @csrf @method('DELETE')
                                        <button
                                            class="px-4 py-3 bg-red-500/40 backdrop-blur-xl border border-white/20 rounded-xl font-semibold w-full">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-white/70">Belum ada jadwal.</p>
                        @endforelse
                    </div>

                    <!-- PAGINATION -->
                    <div class="mt-6">
                        {{ $timetables->links() }}
                    </div>


                </div>
            </main>

            @include('layouts.components._footer')
        </div>
    </div>
</div>
</body>
</html>
