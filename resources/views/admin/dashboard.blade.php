<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ABSENSIKU - Dashboard Admin</title>

  <script src="https://unpkg.com/alpinejs" defer></script>
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    .slide {
      transition: transform 0.3s ease, opacity 0.3s ease;
    }
  </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-blue-400 to-blue-600 text-gray-900 flex">

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
           z-50 slide transform transition-all duration-300 flex flex-col justify-between"
    :class="sidebarOpen ? 'translate-x-0 opacity-100' : '-translate-x-64 opacity-0'">

    <!-- TOP CONTENT -->
    <div class="p-6">
      <div class="flex items-center gap-3">
        <img src="/images/absensiku-logo.png" class="w-10 h-10 drop-shadow-xl">
        <h2 class="text-2xl font-bold text-white drop-shadow">ABSENSIKU</h2>
      </div>

      <nav class="mt-8 space-y-3 text-white font-semibold">
        <a href="#" class="block px-4 py-2 rounded-xl bg-white/20 hover:bg-white/30 transition">Dashboard</a>
        <a href="#" class="block px-4 py-2 rounded-xl text-white/80 hover:bg-white/30 transition">Data Siswa</a>
        <a href="#" class="block px-4 py-2 rounded-xl text-white/80 hover:bg-white/30 transition">Rekap Absen</a>
        <a href="#" class="block px-4 py-2 rounded-xl text-white/80 hover:bg-white/30 transition">Pengaturan</a>
      </nav>
    </div>

    <!-- LOGOUT BOTTOM -->
    <div class="p-6 border-t border-white/20 bg-white/10 backdrop-blur-xl">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="w-full px-4 py-2 bg-red-500/70 hover:bg-red-500/80 text-white rounded-xl transition font-semibold">
          Logout
        </button>
      </form>
    </div>

  </aside>

  <!-- WRAPPER UTAMA -->
  <div class="flex-1 flex flex-col transition-all duration-300">

    <!-- HEADER -->
    <header class="w-full bg-white/20 backdrop-blur-xl border-b border-white/20 shadow-lg p-4 
                    flex items-center justify-between">

      <div class="flex items-center gap-3">

        <!-- TOGGLE SIDEBAR -->
        <button @click="sidebarOpen = !sidebarOpen" class="text-white text-2xl font-bold">
          ☰
        </button>

        <!-- LOGO MOBILE -->
        <img src="/images/absensiku-logo.png" class="w-8 h-8 drop-shadow-xl lg:hidden">

        <!-- LOGO DESKTOP -->
        <img src="/images/absensiku-logo.png" class="hidden lg:block w-10 h-10 drop-shadow-xl">

        <h1 class="text-2xl font-bold text-white drop-shadow">Dashboard Admin</h1>
      </div>

      <div class="flex items-center gap-4">
        <span class="text-white font-semibold">Admin</span>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="px-4 py-2 bg-red-500/70 hover:bg-red-500/80 rounded-xl text-white transition">
            Logout
          </button>
        </form>
      </div>
    </header>

    <!-- CONTENT -->
    <main class="p-6 space-y-8">

      <!-- SUMMARY CARDS -->
      <div class="flex flex-wrap gap-6">

        <div class="flex-1 min-w-[220px] bg-white/30 backdrop-blur-xl rounded-2xl p-6 shadow-xl border border-white/20 hover:scale-[1.03] transition-transform duration-300">
          <h3 class="text-lg font-semibold text-white">Total Siswa</h3>
          <p class="text-4xl font-bold text-white mt-2">320</p>
        </div>

        <div class="flex-1 min-w-[220px] bg-white/30 backdrop-blur-xl rounded-2xl p-6 shadow-xl border border-white/20 hover:scale-[1.03] transition-transform duration-300">
          <h3 class="text-lg font-semibold text-white">Hari Ini Hadir</h3>
          <p class="text-4xl font-bold text-white mt-2">289</p>
        </div>

        <div class="flex-1 min-w-[220px] bg-white/30 backdrop-blur-xl rounded-2xl p-6 shadow-xl border border-white/20 hover:scale-[1.03] transition-transform duration-300">
          <h3 class="text-lg font-semibold text-white">Tidak Hadir</h3>
          <p class="text-4xl font-bold text-white mt-2">31</p>
        </div>

        <div class="flex-1 min-w-[220px] bg-white/30 backdrop-blur-xl rounded-2xl p-6 shadow-xl border border-white/20 hover:scale-[1.03] transition-transform duration-300">
          <h3 class="text-lg font-semibold text-white">Izin</h3>
          <p class="text-4xl font-bold text-white mt-2">12</p>
        </div>

        <div class="flex-1 min-w-[220px] bg-white/30 backdrop-blur-xl rounded-2xl p-6 shadow-xl border border-white/20 hover:scale-[1.03] transition-transform duration-300">
          <h3 class="text-lg font-semibold text-white">Sakit</h3>
          <p class="text-4xl font-bold text-white mt-2">8</p>
        </div>

      </div>

      <!-- TABLE -->
      <div class="bg-white/30 backdrop-blur-xl border border-white/20 rounded-2xl shadow-xl p-6">
        <h2 class="text-xl font-bold text-white mb-4">Absensi Hari Ini</h2>

        <div class="overflow-x-auto">
          <table class="w-full text-white min-w-[600px]">
            <thead>
              <tr class="text-left bg-white/20">
                <th class="p-3">Nama</th>
                <th class="p-3">Kelas</th>
                <th class="p-3">Status</th>
                <th class="p-3">Jam Absen</th>
              </tr>
            </thead>
            <tbody>
              <tr class="border-b border-white/10 hover:bg-white/10 transition">
                <td class="p-3">Ridwan Pratama</td>
                <td class="p-3">XI RPL 1</td>
                <td class="p-3"><span class="px-3 py-1 bg-green-500/70 rounded-xl">Hadir</span></td>
                <td class="p-3">07:02</td>
              </tr>

              <tr class="border-b border-white/10 hover:bg-white/10 transition">
                <td class="p-3">Bilal Akbar</td>
                <td class="p-3">XI TKJ 2</td>
                <td class="p-3"><span class="px-3 py-1 bg-red-500/70 rounded-xl">Tidak Hadir</span></td>
                <td class="p-3">-</td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>

    </main>

  </div>

</body>
</html>
