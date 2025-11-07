<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ABSENSIKU - Dashboard Admin</title>
  <script src="https://unpkg.com/alpinejs" defer></script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-400 to-blue-600 text-gray-900">

  <!-- SIDEBAR -->
  <div class="fixed inset-y-0 left-0 w-64 bg-white/30 backdrop-blur-xl shadow-xl border-r border-white/20 transform transition-transform duration-300"
       :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
    <div class="p-6">
      <h2 class="text-2xl font-bold text-white drop-shadow">ABSENSIKU</h2>
      <nav class="mt-8 space-y-3">
        <a href="#" class="block px-4 py-2 rounded-xl text-white bg-white/20 hover:bg-white/30">Dashboard</a>
        <a href="#" class="block px-4 py-2 rounded-xl text-white/80 hover:bg-white/30">Data Siswa</a>
        <a href="#" class="block px-4 py-2 rounded-xl text-white/80 hover:bg-white/30">Rekap Absen</a>
        <a href="#" class="block px-4 py-2 rounded-xl text-white/80 hover:bg-white/30">Pengaturan</a>
      </nav>
    </div>
  </div>

  <!-- TOPBAR -->
  <header class="w-full bg-white/20 backdrop-blur-xl border-b border-white/20 shadow-lg p-4 flex items-center justify-between">
    <button @click="sidebarOpen = !sidebarOpen" class="text-white text-xl font-bold lg:hidden">☰</button>
    <h1 class="text-2xl font-bold text-white drop-shadow">Dashboard Admin</h1>

    <div class="flex items-center gap-4">
      <span class="text-white font-semibold">Admin</span>
      <form method="POST" action="/logout">
        <button class="px-4 py-2 bg-white/20 hover:bg-white/30 rounded-xl text-white">Logout</button>
      </form>
    </div>
  </header>


  <!-- MAIN CONTENT -->
  <main class="p-6 lg:ml-64 mt-4">

    <!-- SUMMARY CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

      <div class="bg-white/30 backdrop-blur-xl rounded-2xl p-6 shadow-xl border border-white/20">
        <h3 class="text-lg font-semibold text-white">Total Siswa</h3>
        <p class="text-4xl font-bold text-white mt-2">320</p>
      </div>

      <div class="bg-white/30 backdrop-blur-xl rounded-2xl p-6 shadow-xl border border-white/20">
        <h3 class="text-lg font-semibold text-white">Hari Ini Hadir</h3>
        <p class="text-4xl font-bold text-white mt-2">289</p>
      </div>

      <div class="bg-white/30 backdrop-blur-xl rounded-2xl p-6 shadow-xl border border-white/20">
        <h3 class="text-lg font-semibold text-white">Tidak Hadir</h3>
        <p class="text-4xl font-bold text-white mt-2">31</p>
      </div>

    </div>

    <!-- TABLE -->
    <div class="mt-10 bg-white/30 backdrop-blur-xl border border-white/20 rounded-2xl shadow-xl p-6">
      <h2 class="text-xl font-bold text-white mb-4">Absensi Hari Ini</h2>

      <div class="overflow-x-auto">
        <table class="w-full text-white">
          <thead>
            <tr class="text-left bg-white/20">
              <th class="p-3">Nama</th>
              <th class="p-3">Kelas</th>
              <th class="p-3">Status</th>
              <th class="p-3">Jam Absen</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-b border-white/10">
              <td class="p-3">Ridwan Pratama</td>
              <td class="p-3">XI RPL 1</td>
              <td class="p-3"><span class="px-3 py-1 bg-green-500/70 rounded-xl">Hadir</span></td>
              <td class="p-3">07:02</td>
            </tr>

            <tr class="border-b border-white/10">
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

</body>
</html>
