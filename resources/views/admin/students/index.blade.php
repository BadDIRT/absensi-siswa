<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>ABSENSIKU - Data Siswa/i</title>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.1/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex flex-col @include('layouts.components._bgColor') text-white">

<div class="flex flex-1">

    @include('layouts.components._overlay')
    @include('layouts.components._sidebar')

    <div class="p-4 sm:p-6 w-full">

        @include('layouts.components._logo')
        @include('layouts.components._sidebarMenu')

        <div class="flex-1 flex flex-col transition-all duration-300">

            <!-- HEADER -->
            <header class="sticky top-0 z-40 w-full bg-white/10 backdrop-blur-2xl border-b border-white/10 shadow-xl p-3 sm:p-4 flex flex-wrap gap-3 items-center justify-between rounded-2xl">
                <div class="flex items-center gap-3 w-full sm:w-auto justify-between">
                    <div class="flex items-center gap-3">
                        <button @click="sidebarOpen = !sidebarOpen"
                            class="text-white text-2xl font-bold transform transition duration-300 hover:scale-125 hover:text-blue-300">☰
                        </button>

                        <img src="/images/absensiku-logo.png" class="hidden lg:block w-10 h-10 drop-shadow-xl">

                        <h1 class="text-xl sm:text-2xl font-bold drop-shadow">
                            Data Siswa/i
                        </h1>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
    <a href="{{ route('students.create') }}"
        class="px-4 py-2 bg-white/10 backdrop-blur-2xl hover:bg-white/20 border border-white/20 hover:scale-105 hover:shadow-lg text-white rounded-xl transition-all duration-300 font-semibold text-center">
        + Tambah Siswa
    </a>

    <a href="{{ route('students.barcode.create') }}"
        class="px-4 py-2 bg-emerald-500/30 hover:bg-emerald-500/50 border border-white/20 hover:scale-105 hover:shadow-lg text-white rounded-xl transition-all duration-300 font-semibold text-center">
        Buat Kode Batang
    </a>
</div>

            </header>

            @include('layouts.components._alertMessage')

            <!-- MAIN CONTENT -->
            <main class="p-2 sm:p-6 space-y-4 sm:space-y-8 flex-1 mt-4">

                <div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-3xl shadow-2xl p-4 sm:p-6 overflow-x-auto">

                    <!-- FORM FILTER + SEARCH -->
                    <form method="GET" x-data="{ openFilter: false }"
                        class="mb-6 bg-white/10 backdrop-blur-2xl border border-white/20 rounded-2xl p-4 sm:p-5 shadow-xl space-y-4 transition">

                        @include('layouts.components._searchBar')
                        @include('layouts.components._filterToggleButton')

                        <div x-show="openFilter" x-transition.duration.400ms
                            class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">

                            <div class="flex flex-col gap-1">
                                <label class="text-sm text-white/70">Filter Berdasarkan</label>
                                <select name="filter_field"
                                    class="px-4 py-3 rounded-xl bg-white/20 backdrop-blur-xl text-white border border-white/30 focus:ring-2 focus:ring-white/40 transition">
                                    <option value="" class="text-black">— Pilih Filter —</option>
                                    <option value="name" class="text-black">Nama</option>
                                    <option value="gender" class="text-black">Jenis Kelamin</option>
                                    <option value="nisn" class="text-black">NISN</option>
                                    <option value="class" class="text-black">Kelas</option>
                                    <option value="department" class="text-black">Jurusan</option>
                                </select>
                            </div>

                            @include('layouts.components._filterValue')
                            @include('layouts.components._sorting')
                        </div>

                        @include('layouts.components._submitButton')
                    </form>

                    <h2 class="text-lg sm:text-xl font-bold mb-4 drop-shadow">
                        Daftar Siswa/i
                    </h2>

                    <!-- DESKTOP TABLE -->
                    <table class="w-full min-w-[900px] text-white text-xs sm:text-base hidden md:table">
                        <thead>
                            <tr class="bg-white/10 border-b border-white/20">
                                <th class="p-3">No</th>
                                <th class="p-3">Nama</th>
                                <th class="p-3">JK</th>
                                <th class="p-3">Tanggal Lahir</th>
                                <th class="p-3">NISN</th>
                                <th class="p-3">NIPD</th>
                                <th class="p-3">Alamat</th>
                                <th class="p-3">Kelas</th>
                                <th class="p-3">Jurusan</th>
                                <th class="p-3">Kode Batang</th>
                                <th class="p-3 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($students as $s)
                                <tr class="border-b border-white/10 hover:bg-white/10 transition-all duration-300">
                                    <td class="p-3">{{ $loop->iteration }}</td>
                                    <td class="p-3">{{ $s->name }}</td>
                                    <td class="p-3">{{ $s->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td class="p-3">{{ \Carbon\Carbon::parse($s->date_of_birth)->translatedFormat('d F Y') }}</td>
                                    <td class="p-3">{{ $s->nisn }}</td>
                                    <td class="p-3">{{ $s->nipd }}</td>
                                    <td class="p-3">{{ $s->address ?? '-' }}</td>
                                    <td class="p-3">{{ $s->class->grade ?? '-' }}</td>
                                    <td class="p-3">{{ $s->department->name ?? '-' }}</td>
                                    <td class="p-3">
                                        @if($s->barcode)
    <img src="{{ asset('storage/'.$s->barcode) }}" class="mx-auto">
    <p class="text-xs mt-1">{{ $s->nipd }}</p>
@else
    <span class="text-white/60">-</span>
@endif

                                    </td>
                                    <td class="p-3 text-center">
                                        <a href="{{ route('students.show', $s->id) }}"
                                           class="px-6 py-1 bg-blue-500/40 hover:bg-blue-500/60 border border-white/20 rounded-lg font-semibold transition">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center py-4 text-white/60">
                                        Belum ada data siswa.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- MOBILE CARDS -->
<div class="block md:hidden space-y-4 mt-4">
    @forelse($students as $s)
        <div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-2xl p-4 shadow-2xl">

            <div class="flex justify-between items-center">
                <h3 class="text-lg font-bold">{{ $s->name }}</h3>
                <span class="text-xs bg-white/10 px-3 py-1 rounded-lg">
                    {{ $s->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}
                </span>
            </div>

            <div class="mt-4 grid grid-cols-2 gap-3 text-sm">

                <div class="bg-white/5 p-3 rounded-xl">
                    <span class="text-xs opacity-70">📅 Tanggal Lahir</span>
                    <p class="font-semibold">
                        {{ \Carbon\Carbon::parse($s->date_of_birth)->translatedFormat('d F Y') }}
                    </p>
                </div>

                <div class="bg-white/5 p-3 rounded-xl">
                    <span class="text-xs opacity-70">🎓 Kelas</span>
                    <p class="font-semibold">{{ $s->class->grade ?? '-' }}</p>
                </div>

                <div class="bg-white/5 p-3 rounded-xl col-span-2">
                    <span class="text-xs opacity-70">🏫 Jurusan</span>
                    <p class="font-semibold">{{ $s->department->name ?? '-' }}</p>
                </div>

                <div class="bg-white/5 p-3 rounded-xl col-span-2">
                    <span class="text-xs opacity-70">📍 Alamat</span>
                    <p class="font-semibold">{{ $s->address ?? '-' }}</p>
                </div>

                <div class="bg-white/5 p-3 rounded-xl col-span-2 flex flex-col items-center">
                    <span class="text-xs opacity-70 mb-2">📦 Kode Batang</span>

                    @if($s->barcode)
    <img src="{{ asset('storage/'.$s->barcode) }}" class="mx-auto">
    <p class="text-xs mt-1">{{ $s->nipd }}</p>
@else
    <span class="text-white/60">-</span>
@endif

                </div>

            </div>

            <div class="mt-5">
                <a href="{{ route('students.show', $s->id) }}"
                   class="block w-full px-4 py-3 bg-blue-500/40 border border-white/20 rounded-xl font-semibold text-center">
                    Detail
                </a>
            </div>

        </div>
    @empty
        <p class="text-center text-white/70">Belum ada data siswa.</p>
    @endforelse
</div>


                </div>

                <div class="mt-6">
                    {{ $students->links() }}
                </div>

            </main>

            @include('layouts.components._footer')
        </div>
    </div>
</div>

</body>
</html>
