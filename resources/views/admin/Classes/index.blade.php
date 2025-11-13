<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ABSENSIKU - Data Kelas</title>

  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.1/dist/cdn.min.js"></script>
  @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex flex-col @include('layouts.bgColor') text-gray-900">
  <div class="flex flex-1">

    <!-- OVERLAY -->
    <div 
      x-show="sidebarOpen"
      x-transition.opacity
      @click="sidebarOpen = false"
      class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40">
    </div>

    <!-- SIDEBAR -->
    @include('layouts.sidebar')

    <div class="p-6">
      <div class="flex items-center gap-3">
        <img src="/images/absensiku-logo.png" class="w-10 h-10 drop-shadow-xl">
        <h2 class="text-2xl font-bold text-white drop-shadow">ABSENSIKU</h2>
      </div>

      <!-- ✅ Sidebar Menu -->
      @include('layouts.sidebarMenu')

      <!-- MAIN WRAPPER -->
      <div class="flex-1 flex flex-col transition-all duration-300">

        <!-- HEADER -->
        <header 
          class="sticky top-0 z-40 w-full bg-white/20 backdrop-blur-xl border-b border-white/20 shadow-lg 
                 p-4 flex items-center justify-between">
          <div class="flex items-center gap-3">
            <button @click="sidebarOpen = !sidebarOpen" class="text-white text-2xl font-bold">☰</button>
            <img src="/images/absensiku-logo.png" class="hidden lg:block w-10 h-10 drop-shadow-xl">
            <h1 class="text-2xl font-bold text-white drop-shadow">Data Kelas</h1>
          </div>

          <a href="{{ route('classes.create') }}" 
            class="px-4 py-2 backdrop-blur-lg 
                    hover:scale-105 hover:shadow-lg 
                    text-white rounded-xl transition-all duration-300 font-semibold">
            + Tambah Kelas
          </a>
        </header>

        <!-- ✅ ALERT SUCCESS -->
        @if (session('success'))
        <div 
          x-data="{ show: true }" 
          x-show="show" 
          x-init="setTimeout(() => show = false, 3000)"
          x-transition 
          class="mx-6 mt-4 flex items-center justify-between bg-gradient-to-r from-green-400/70 to-green-600/70 
                 text-white font-semibold px-6 py-3 rounded-xl shadow-lg border border-white/20">
          <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4m5 2a9 9 0 11-18 0a9 9 0 0118 0z" />
            </svg>
            <span>{{ session('success') }}</span>
          </div>
          <button @click="show = false" class="text-white hover:text-white/80 transition">✕</button>
        </div>
        @endif

        <!-- TABLE CONTENT -->
        <main class="p-6 space-y-8 flex-1 mt-4">
          <div class="bg-white/30 backdrop-blur-xl border border-white/20 rounded-2xl shadow-xl p-6 overflow-x-auto">
            <h2 class="text-xl font-bold text-white mb-4">Daftar Kelas</h2>

            <table class="w-full text-white min-w-[800px] text-sm sm:text-base">
              <thead>
                <tr class="text-left bg-white/20">
                  <th class="p-3">No</th>
                  <th class="p-3">Jurusan</th>
                  <th class="p-3">Tingkat</th>
                  <th class="p-3">Wali Kelas</th>
                  <th class="p-3 text-center">Aksi</th>
                </tr>
              </thead>

              <tbody>
                @forelse($classes as $c)
                <tr class="border-b border-white/10 hover:bg-gradient-to-r hover:from-white/20 hover:to-white/10 transition-all duration-300">
                  <td class="p-3">{{ $loop->iteration }}</td>
                  <td class="p-3 font-semibold">{{ $c->department->name ?? '-' }}</td>
                  <td class="p-3">{{ $c->grade }}</td>
                  <td class="p-3">{{ $c->teacher->name ?? '-' }}</td>

                  <td class="p-3 text-center">
                    <div class="flex flex-wrap justify-center gap-2">
                      <a href="{{ route('classes.show', $c->id) }}" 
                        class="px-3 py-1 bg-gradient-to-r from-blue-400/70 to-blue-600/70 
                               hover:from-blue-500 hover:to-blue-400 hover:scale-105 
                               hover:shadow-md text-white rounded-lg font-semibold transition-all duration-300">
                        Detail
                      </a>

                      <a href="{{ route('classes.edit', $c->id) }}" 
                        class="px-3 py-1 bg-gradient-to-r from-yellow-400/70 to-yellow-600/70 
                               hover:from-yellow-500 hover:to-yellow-400 hover:scale-105 
                               hover:shadow-md text-white rounded-lg font-semibold transition-all duration-300">
                        Edit
                      </a>

                      <form action="{{ route('classes.destroy', $c->id) }}" 
                            method="POST" 
                            onsubmit="return confirm('Yakin ingin menghapus data kelas ini?')">
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
                  <td colspan="5" class="text-center py-4 text-white/80">Belum ada data kelas.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </main>

        @include('layouts.footer')
      </div>
    </div>
  </div>
</body>
</html>
