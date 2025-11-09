<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ABSENSIKU - Dashboard Admin</title>

  <script src="https://unpkg.com/alpinejs" defer></script>
  @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex flex-col bg-gradient-to-br from-blue-400 to-blue-600 text-gray-900">

  <div class="flex flex-1">

    <!-- OVERLAY -->
    <div 
      x-show="sidebarOpen"
      x-transition.opacity
      @click="sidebarOpen = false"
      class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40">
    </div>

    <!-- SIDEBAR -->
    <aside
      class="fixed inset-y-0 left-0 w-64 bg-white/30 backdrop-blur-xl shadow-xl border-r border-white/20
             z-50 transform transition-all duration-300 flex flex-col justify-between"
      :class="sidebarOpen ? 'translate-x-0 opacity-100' : '-translate-x-64 opacity-0'">

      <!-- TOP CONTENT -->
      <div class="p-6">
        <div class="flex items-center gap-3">
          <img src="/images/absensiku-logo.png" class="w-10 h-10 drop-shadow-xl">
          <h2 class="text-2xl font-bold text-white drop-shadow">ABSENSIKU</h2>
        </div>

        <nav class="mt-8 space-y-3 text-white font-semibold">
          <template x-for="(item, i) in ['Dashboard','Data Siswa','Rekap Absen','Pengaturan']" :key="i">
            <a href="#" 
              class="block px-4 py-2 rounded-xl bg-white/10 text-white/80
                     hover:bg-gradient-to-r hover:from-blue-400/40 hover:to-indigo-400/40 
                     hover:text-white transition-all duration-300 ease-out transform hover:scale-105 hover:shadow-lg">
              <span x-text="item"></span>
            </a>
          </template>
        </nav>
      </div>

      <!-- LOGOUT BOTTOM -->
      <div class="p-6 border-t border-white/20 bg-white/10 backdrop-blur-xl">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="w-full px-4 py-2 bg-gradient-to-r from-red-500/70 to-red-600/70 
                         hover:from-red-500 hover:to-red-400 hover:scale-105 
                         hover:shadow-lg text-white rounded-xl transition-all duration-300 font-semibold">
            Logout
          </button>
        </form>
      </div>
    </aside>

    <!-- WRAPPER UTAMA -->
    <div class="flex-1 flex flex-col transition-all duration-300">

      <!-- HEADER -->
      <header 
        class="sticky top-0 z-40 w-full bg-white/20 backdrop-blur-xl border-b border-white/20 shadow-lg 
               p-4 flex items-center justify-between">
        
        <div class="flex items-center gap-3">
          <button @click="sidebarOpen = !sidebarOpen" class="text-white text-2xl font-bold">☰</button>
          <img src="/images/absensiku-logo.png" class="hidden lg:block w-10 h-10 drop-shadow-xl">
          <h1 class="text-2xl font-bold text-white drop-shadow">Dashboard Admin</h1>
        </div>

        <div class="flex items-center gap-4 flex-wrap justify-end">
          <a href="{{ route('barcode.scan') }}" 
            class="px-4 py-2 bg-gradient-to-r from-green-400/70 to-green-600/70 
                   hover:from-green-500 hover:to-green-400 hover:scale-105 hover:shadow-lg 
                   text-white rounded-xl transition-all duration-300 font-semibold text-sm sm:text-base">
            Scan Now
          </a>

          <a href="{{ route('barcode.index') }}" 
            class="px-4 py-2 bg-gradient-to-r from-indigo-400/70 to-indigo-600/70 
                   hover:from-indigo-500 hover:to-indigo-400 hover:scale-105 hover:shadow-lg 
                   text-white rounded-xl transition-all duration-300 font-semibold text-sm sm:text-base">
            Generate Barcode
          </a>

          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button 
              class="px-4 py-2 bg-gradient-to-r from-red-400/70 to-red-600/70 
                     hover:from-red-500 hover:to-red-400 hover:scale-105 hover:shadow-lg 
                     text-white rounded-xl transition-all duration-300 font-semibold text-sm sm:text-base">
              Logout
            </button>
          </form>
        </div>
      </header>

      <!-- CONTENT -->
      <main class="p-6 space-y-8 flex-1 mt-4">

        <!-- SUMMARY CARDS -->
        <div class="flex flex-wrap justify-center gap-6">
          @php
            $cardClasses = "bg-white/30 backdrop-blur-xl rounded-2xl p-6 shadow-xl border border-white/20 
                            hover:scale-105 hover:shadow-[0_0_25px_rgba(255,255,255,0.3)] 
                            hover:bg-gradient-to-br hover:from-blue-400/30 hover:to-indigo-400/30
                            transition-all duration-300 ease-out transform flex flex-col items-center 
                            text-center min-w-[240px] sm:min-w-[260px] lg:min-w-[280px] max-w-[300px]";
          @endphp

          <div class="{{ $cardClasses }}">
            <h3 class="text-lg font-semibold text-white">Total Siswa</h3>
            <p class="text-4xl font-bold text-white mt-2">320</p>
          </div>

          <div class="{{ $cardClasses }}">
            <h3 class="text-lg font-semibold text-white">Hari Ini Hadir</h3>
            <p class="text-4xl font-bold text-white mt-2">289</p>
          </div>

          <div class="{{ $cardClasses }}">
            <h3 class="text-lg font-semibold text-white">Tidak Hadir</h3>
            <p class="text-4xl font-bold text-white mt-2">31</p>
          </div>

          <div class="{{ $cardClasses }}">
            <h3 class="text-lg font-semibold text-white">Izin</h3>
            <p class="text-4xl font-bold text-white mt-2">12</p>
          </div>

          <div class="{{ $cardClasses }}">
            <h3 class="text-lg font-semibold text-white">Sakit</h3>
            <p class="text-4xl font-bold text-white mt-2">8</p>
          </div>
        </div>

        <!-- TABLE -->
        <div class="bg-white/30 backdrop-blur-xl border border-white/20 rounded-2xl shadow-xl p-6 overflow-x-auto">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-white">Absensi Hari Ini</h2>
          </div>

          <table class="w-full text-white min-w-[800px] text-sm sm:text-base">
            <thead>
              <tr class="text-left bg-white/20">
                <th class="p-3">Nama</th>
                <th class="p-3">Kelas</th>
                <th class="p-3">Status</th>
                <th class="p-3">Jam Absen</th>
                <th class="p-3">Guru Piket</th>
                <th class="p-3 text-center">Barcode</th> <!-- ✅ Tambahan kolom -->
                <th class="p-3 text-center">Aksi</th>
              </tr>
            </thead>

            <tbody>
              @foreach ($attendances as $attendance)
              <tr class="border-b border-white/10 hover:bg-gradient-to-r hover:from-white/20 hover:to-white/10 transition-all duration-300">
                <td class="p-3">{{ $attendance->student->name }}</td>
                <td class="p-3">
                  {{ $attendance->student->class->grade ?? '-' }} 
                  {{ $attendance->student->class->department->name ?? '-' }}
                </td>
                <td class="p-3">{{ ucfirst($attendance->status) }}</td>
                <td class="p-3">{{ $attendance->time_in ?? '-' }}</td>
                <td class="p-3">{{ $attendance->teacher->name ?? '-' }}</td>

                <!-- ✅ Kolom Barcode -->
                <td class="p-3 text-center">
                  @if(!empty($attendance->student->barcode))
                    <img src="{{ asset('storage/barcodes/' . $attendance->student->barcode . '.png') }}" 
                         alt="Barcode" class="h-12 mx-auto rounded-md shadow-md hover:scale-105 transition-transform duration-300">
                    <p class="text-xs text-white/80 mt-1">{{ $attendance->student->barcode }}</p>
                  @else
                    <span class="text-white/60 italic">Belum ada</span>
                  @endif
                </td>

                <!-- Tombol Aksi -->
                <td class="p-3 text-center">
                  <div class="flex flex-wrap justify-center gap-2">
                    <a href="{{ route('attendances.show', $attendance->id) }}" 
                      class="px-3 py-1 bg-gradient-to-r from-green-400/70 to-green-600/70 
                             hover:from-green-500 hover:to-green-400 hover:scale-105 
                             hover:shadow-md text-white rounded-lg font-semibold transition-all duration-300">
                      Show
                    </a>
                    <a href="{{ route('attendances.edit', $attendance->id) }}" 
                      class="px-3 py-1 bg-gradient-to-r from-yellow-400/70 to-yellow-600/70 
                             hover:from-yellow-500 hover:to-yellow-400 hover:scale-105 
                             hover:shadow-md text-white rounded-lg font-semibold transition-all duration-300">
                      Edit
                    </a>
                    <form action="{{ route('attendances.destroy', $attendance->id) }}" 
                          method="POST" class="inline"
                          onsubmit="return confirm('Hapus data ini?')">
                      @csrf
                      @method('DELETE')
                      <button 
                        class="px-3 py-1 bg-gradient-to-r from-red-400/70 to-red-600/70 
                               hover:from-red-500 hover:to-red-400 hover:scale-105 
                               hover:shadow-md text-white rounded-lg font-semibold transition-all duration-300">
                        Delete
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

      </main>

      <!-- FOOTER -->
      @include('layouts.footer')
    </div>
  </div>
</body>
</html>
