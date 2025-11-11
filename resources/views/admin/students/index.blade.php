<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ABSENSIKU - Data Siswa</title>

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

      <div class="p-6">
        <div class="flex items-center gap-3">
          <img src="/images/absensiku-logo.png" class="w-10 h-10 drop-shadow-xl">
          <h2 class="text-2xl font-bold text-white drop-shadow">ABSENSIKU</h2>
        </div>

        <!-- ✅ Sidebar Menu -->
        <nav class="mt-8 space-y-3 text-white font-semibold">
          <a href="{{ route('admin.dashboard') }}" 
            class="block px-4 py-2 rounded-xl 
              {{ request()->routeIs('admin.dashboard') 
                  ? 'bg-gradient-to-r from-blue-500/70 to-indigo-500/70 text-white shadow-lg' 
                  : 'bg-white/10 text-white/80 hover:bg-gradient-to-r hover:from-blue-400/40 hover:to-indigo-400/40 hover:text-white' }}
              transition-all duration-300 ease-out transform hover:scale-105">
            🏠 Dashboard
          </a>

          <a href="{{ route('students.index') }}" 
            class="block px-4 py-2 rounded-xl 
              {{ request()->routeIs('students.*') 
                  ? 'bg-gradient-to-r from-blue-500/70 to-indigo-500/70 text-white shadow-lg' 
                  : 'bg-white/10 text-white/80 hover:bg-gradient-to-r hover:from-blue-400/40 hover:to-indigo-400/40 hover:text-white' }}
              transition-all duration-300 ease-out transform hover:scale-105">
            👨‍🎓 Data Siswa
          </a>

          <a href="{{ route('attendances.index') }}" 
            class="block px-4 py-2 rounded-xl 
              {{ request()->routeIs('attendances.*') 
                  ? 'bg-gradient-to-r from-blue-500/70 to-indigo-500/70 text-white shadow-lg' 
                  : 'bg-white/10 text-white/80 hover:bg-gradient-to-r hover:from-blue-400/40 hover:to-indigo-400/40 hover:text-white' }}
              transition-all duration-300 ease-out transform hover:scale-105">
            📋 Rekap Absen
          </a>

          <a href="{{ route('barcode.index') }}" 
            class="block px-4 py-2 rounded-xl 
              {{ request()->routeIs('barcode.*') 
                  ? 'bg-gradient-to-r from-blue-500/70 to-indigo-500/70 text-white shadow-lg' 
                  : 'bg-white/10 text-white/80 hover:bg-gradient-to-r hover:from-blue-400/40 hover:to-indigo-400/40 hover:text-white' }}
              transition-all duration-300 ease-out transform hover:scale-105">
            ⚙️ Pengaturan
          </a>
        </nav>
      </div>

      <!-- LOGOUT -->
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

    <!-- ✅ MAIN WRAPPER -->
    <div class="flex-1 flex flex-col transition-all duration-300">

      <!-- HEADER -->
      <header 
        class="sticky top-0 z-40 w-full bg-white/20 backdrop-blur-xl border-b border-white/20 shadow-lg 
               p-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
          <button @click="sidebarOpen = !sidebarOpen" class="text-white text-2xl font-bold">☰</button>
          <img src="/images/absensiku-logo.png" class="hidden lg:block w-10 h-10 drop-shadow-xl">
          <h1 class="text-2xl font-bold text-white drop-shadow">Data Siswa</h1>
        </div>

        <a href="{{ route('students.create') }}" 
          class="px-4 py-2 bg-gradient-to-r from-blue-400/70 to-indigo-600/70 
                 hover:from-blue-500 hover:to-indigo-500 hover:scale-105 hover:shadow-lg 
                 text-white rounded-xl transition-all duration-300 font-semibold">
          + Tambah Siswa
        </a>
      </header>

      <!-- MAIN CONTENT -->
      <main class="p-6 space-y-8 flex-1 mt-4">

        <div class="bg-white/30 backdrop-blur-xl border border-white/20 rounded-2xl shadow-xl p-6 overflow-x-auto">
          <h2 class="text-xl font-bold text-white mb-4">Daftar Siswa</h2>

          <table class="w-full text-white min-w-[800px] text-sm sm:text-base">
            <thead>
              <tr class="text-left bg-white/20">
                <th class="p-3">No</th>
                <th class="p-3">Nama</th>
                <th class="p-3">JK</th>
                <th class="p-3">Tanggal Lahir</th>
                <th class="p-3">Kelas</th>
                <th class="p-3">Jurusan</th>
                <th class="p-3 text-center">Aksi</th>
              </tr>
            </thead>

            <tbody>
              @forelse($students as $s)
              <tr class="border-b border-white/10 hover:bg-gradient-to-r hover:from-white/20 hover:to-white/10 transition-all duration-300">
                <td class="p-3">{{ $loop->iteration }}</td>
                <td class="p-3">{{ $s->name }}</td>
                <td class="p-3">{{ $s->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                <td class="p-3">{{ $s->date_of_birth }}</td>
                <td class="p-3">{{ $s->class->grade ?? '-' }}</td>
                <td class="p-3">{{ $s->department->name ?? '-' }}</td>

                <td class="p-3 text-center">
                  <div class="flex flex-wrap justify-center gap-2">

                    <!-- DETAIL -->
                    <a href="{{ route('students.show', $s->id) }}" 
                      class="px-3 py-1 bg-gradient-to-r from-blue-400/70 to-blue-600/70 
                             hover:from-blue-500 hover:to-blue-400 hover:scale-105 
                             hover:shadow-md text-white rounded-lg font-semibold transition-all duration-300">
                      Detail
                    </a>

                    <!-- EDIT -->
                    <a href="{{ route('students.edit', $s->id) }}" 
                      class="px-3 py-1 bg-gradient-to-r from-yellow-400/70 to-yellow-600/70 
                             hover:from-yellow-500 hover:to-yellow-400 hover:scale-105 
                             hover:shadow-md text-white rounded-lg font-semibold transition-all duration-300">
                      Edit
                    </a>

                    <!-- DELETE -->
                    <form action="{{ route('students.destroy', $s->id) }}" 
                          method="POST" 
                          onsubmit="return confirm('Yakin ingin menghapus data siswa ini?')">
                      @csrf
                      @method('DELETE')
                      <button 
                        class="px-3 py-1 bg-gradient-to-r from-red-400/70 to-red-600/70 
                               hover:from-red-500 hover:to-red-400 hover:scale-105 
                               hover:shadow-md text-white rounded-lg font-semibold transition-all duration-300">
                        Hapus
                      </button>
                    </form>

                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="7" class="text-center py-4 text-white/80">Belum ada data siswa.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </main>

      <!-- FOOTER -->
      <footer class="w-full text-center text-white/70 text-sm py-4 border-t border-white/20 bg-white/10 backdrop-blur-xl">
        © {{ date('Y') }} ABSENSIKU - Sistem Absensi Sekolah
      </footer>

    </div>
  </div>
</body>
</html>
