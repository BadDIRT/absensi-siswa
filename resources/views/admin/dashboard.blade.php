<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false }">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Sistem Absensi</title>
  @vite('resources/css/app.css')
  <script src="https://unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-50 text-gray-800">

  <!-- Sidebar -->
  <div class="flex">
    <!-- Overlay untuk mobile -->
<div 
  x-show="sidebarOpen"
  @click="sidebarOpen = false"
  class="fixed inset-0 bg-white/50 backdrop-blur-sm z-30 lg:hidden transition"
></div>


    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
      class="fixed inset-y-0 left-0 bg-blue-700 text-white w-64 transform transition-transform duration-300 lg:translate-x-0 z-40">
      <div class="flex items-center justify-center h-16 border-b border-blue-500">
        <h1 class="text-2xl font-bold">ABSENSI<span class="text-red-400">KU</span></h1>
      </div>
      <nav class="p-4 space-y-2">
        <a href="#" class="flex items-center px-3 py-2 rounded-lg hover:bg-blue-600 transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8v8m4-8l2 2m-8 0h.01" />
          </svg>
          Dashboard
        </a>
        <a href="#" class="flex items-center px-3 py-2 rounded-lg hover:bg-blue-600 transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5 13l4 4L19 7" />
          </svg>
          Data Absensi
        </a>
        <a href="#" class="flex items-center px-3 py-2 rounded-lg hover:bg-blue-600 transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          Laporan
        </a>
        <a href="{{ route('logout') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-blue-600 transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M17 16l4-4m0 0l-4-4m4 4H7" />
          </svg>
          Logout
        </a>
      </nav>
    </aside>

    <!-- Main content -->
    <div class="flex-1 flex flex-col min-h-screen lg:ml-64">
      
      <!-- Top Navbar -->
      <header class="flex items-center justify-between bg-white shadow px-6 py-3">
        <div class="flex items-center">
          <button @click="sidebarOpen = !sidebarOpen" class="text-blue-700 focus:outline-none lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
          <h2 class="text-xl font-semibold text-gray-700 ml-3">Dashboard</h2>
        </div>
        <div class="flex items-center space-x-3">
          <span class="text-gray-700 text-sm">Hi, <b>Admin</b></span>
          <img src="https://i.pravatar.cc/40" alt="Avatar" class="w-9 h-9 rounded-full border-2 border-blue-500">
        </div>
      </header>

      <!-- Dashboard Cards -->
      <main class="flex-1 p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          
          <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition">
            <h3 class="text-gray-600 text-sm mb-2">Total Siswa Hadir</h3>
            <p class="text-3xl font-bold text-blue-600">120</p>
          </div>

          <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition">
            <h3 class="text-gray-600 text-sm mb-2">Tidak Hadir</h3>
            <p class="text-3xl font-bold text-red-500">8</p>
          </div>

          <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition">
            <h3 class="text-gray-600 text-sm mb-2">Izin / Sakit</h3>
            <p class="text-3xl font-bold text-yellow-500">5</p>
          </div>
        </div>

        <!-- Table Section -->
        <div class="mt-8 bg-white rounded-xl shadow overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-blue-600 text-white">
              <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Nama</th>
                <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Kelas</th>
                <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Status</th>
                <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Waktu</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
              <tr class="hover:bg-blue-50">
                <td class="px-6 py-4 text-gray-700">Ridwan</td>
                <td class="px-6 py-4 text-gray-700">XII IPA 1</td>
                <td class="px-6 py-4">
                  <span class="bg-green-100 text-green-600 text-xs font-semibold px-3 py-1 rounded-full">Hadir</span>
                </td>
                <td class="px-6 py-4 text-gray-500 text-sm">07:30 WIB</td>
              </tr>
              <tr class="hover:bg-blue-50">
                <td class="px-6 py-4 text-gray-700">Nawaf</td>
                <td class="px-6 py-4 text-gray-700">XII IPA 2</td>
                <td class="px-6 py-4">
                  <span class="bg-red-100 text-red-600 text-xs font-semibold px-3 py-1 rounded-full">Alpa</span>
                </td>
                <td class="px-6 py-4 text-gray-500 text-sm">-</td>
              </tr>
              <tr class="hover:bg-blue-50">
                <td class="px-6 py-4 text-gray-700">Hendi</td>
                <td class="px-6 py-4 text-gray-700">XII IPS 1</td>
                <td class="px-6 py-4">
                  <span class="bg-yellow-100 text-yellow-600 text-xs font-semibold px-3 py-1 rounded-full">Izin</span>
                </td>
                <td class="px-6 py-4 text-gray-500 text-sm">08:00 WIB</td>
              </tr>
            </tbody>
          </table>
        </div>
      </main>

      <!-- Footer -->
      <footer class="text-center py-4 text-sm text-gray-400 border-t mt-auto">
        © 2025 Sistem Absensi Siswa — <span class="text-blue-600">Versi 1.0</span>
      </footer>
    </div>
  </div>

</body>
</html>
