<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ABSENSIKU - Generate Barcode</title>

  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.1/dist/cdn.min.js"></script>
  @vite('resources/css/app.css')

  <style>
    select {
      color: #1e3a8a !important;
      background-color: rgba(255, 255, 255, 0.9) !important;
      border-radius: 0.5rem !important;
      padding: 0.5rem !important;
      font-weight: 500;
    }
    option {
      color: #1e3a8a !important;
    }
  </style>
</head>

<body class="min-h-screen flex flex-col bg-gradient-to-br from-blue-400 to-blue-600 text-white">

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

        <nav class="mt-8 space-y-3 text-white font-semibold">
          <a href="{{ route('admin.dashboard') }}" 
            class="block px-4 py-2 rounded-xl bg-white/10 text-white/90
                   hover:bg-gradient-to-r hover:from-blue-400/40 hover:to-indigo-400/40
                   hover:text-white transition-all duration-300 ease-out transform hover:scale-105 hover:shadow-lg">
            Dashboard
          </a>

          <a href="" 
            class="block px-4 py-2 rounded-xl bg-white/10 text-white/80
                   hover:bg-gradient-to-r hover:from-blue-400/40 hover:to-indigo-400/40
                   hover:text-white transition-all duration-300 ease-out transform hover:scale-105 hover:shadow-lg">
            Data Siswa
          </a>

          <a href="" 
            class="block px-4 py-2 rounded-xl bg-white/10 text-white/80
                   hover:bg-gradient-to-r hover:from-blue-400/40 hover:to-indigo-400/40
                   hover:text-white transition-all duration-300 ease-out transform hover:scale-105 hover:shadow-lg">
            Rekap Absen
          </a>

          <a href="" 
            class="block px-4 py-2 rounded-xl bg-white/10 text-white/80
                   hover:bg-gradient-to-r hover:from-blue-400/40 hover:to-indigo-400/40
                   hover:text-white transition-all duration-300 ease-out transform hover:scale-105 hover:shadow-lg">
            Pengaturan
          </a>
        </nav>
      </div>

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

    <!-- WRAPPER -->
    <div class="flex-1 flex flex-col transition-all duration-300">

      <!-- HEADER -->
      <header 
        class="sticky top-0 z-40 w-full bg-white/20 backdrop-blur-xl border-b border-white/20 shadow-lg 
               p-4 flex items-center justify-between">
        
        <div class="flex items-center gap-3">
          <button @click="sidebarOpen = !sidebarOpen" class="text-white text-2xl font-bold">☰</button>
          <img src="/images/absensiku-logo.png" class="hidden lg:block w-10 h-10 drop-shadow-xl">
          <h1 class="text-2xl font-bold text-white drop-shadow">Generate Barcode</h1>
        </div>

        <div class="flex items-center gap-4 flex-wrap justify-end">
          <a href="{{ route('admin.dashboard') }}" 
            class="px-4 py-2 bg-gradient-to-r from-indigo-400/70 to-indigo-600/70 
                   hover:from-indigo-500 hover:to-indigo-400 hover:scale-105 hover:shadow-lg 
                   text-white rounded-xl transition-all duration-300 font-semibold text-sm sm:text-base">
            ← Dashboard
          </a>
        </div>
      </header>

      <!-- MAIN CONTENT -->
      <main class="flex flex-col items-center justify-center mt-12 px-6 flex-1">

        <div class="bg-white/30 backdrop-blur-xl border border-white/20 rounded-2xl shadow-xl p-8 w-full max-w-lg text-center">
          <h2 class="text-2xl font-bold text-white mb-3">Generate Barcode</h2>
          <p class="text-white/80 mb-6">Pilih opsi untuk membuat barcode siswa secara otomatis atau manual.</p>

          <form method="POST" action="{{ route('barcode.generate') }}" class="text-left">
  @csrf

  <!-- Opsi Barcode -->
  <label class="block mb-2 font-semibold">Pilih Opsi:</label>
  <select name="option" class="w-full p-2 rounded text-blue-900 mb-4">
    <option value="1">Isi 6 digit pertama, 3 digit terakhir acak</option>
    <option value="2">Isi 9 digit manual</option>
  </select>

  <label class="block mb-2 font-semibold">Kode Manual:</label>
  <input type="text" name="manual_code" 
         class="w-full p-2 rounded text-blue-900 mb-4" 
         placeholder="Contoh: 123456 / 123456789">

  <!-- Data Siswa -->
  <label class="block mb-2 font-semibold">Nama Lengkap:</label>
  <input type="text" name="name" class="w-full p-2 rounded text-blue-900 mb-4" placeholder="Nama Siswa" required>

  <label class="block mb-2 font-semibold">Jenis Kelamin:</label>
  <select name="gender" class="w-full p-2 rounded text-blue-900 mb-4">
    <option value="L">Laki-laki</option>
    <option value="P">Perempuan</option>
  </select>

  <label class="block mb-2 font-semibold">Tanggal Lahir:</label>
  <input type="date" name="date_of_birth" class="w-full p-2 rounded text-blue-900 mb-4" required>

  <label class="block mb-2 font-semibold">Kelas:</label>
  <select name="class_id" class="w-full p-2 rounded text-blue-900 mb-4">
    @foreach($classes as $class)
      <option value="{{ $class->id }}">{{ $class->grade }}</option>
    @endforeach
  </select>

  <label class="block mb-2 font-semibold">Jurusan:</label>
  <select name="department_id" class="w-full p-2 rounded text-blue-900 mb-6">
    @foreach($departments as $department)
      <option value="{{ $department->id }}">{{ $department->name }}</option>
    @endforeach
  </select>

  <button 
    type="submit"
    class="w-full bg-gradient-to-r from-blue-500/80 to-indigo-600/80 
           hover:from-blue-500 hover:to-indigo-500 hover:scale-105 
           transition-all duration-300 text-white font-semibold py-2 rounded-xl shadow-lg">
    Generate Sekarang
  </button>
</form>

@if(session('success'))
  <div class="mt-6 p-4 bg-green-500/30 border border-green-400 rounded-xl text-center">
    <p class="font-semibold text-white">{{ session('success') }}</p>
    <p class="text-sm text-white/80">Nama: {{ session('student_name') }}</p>
    <p class="text-sm text-white/80">Kode: {{ session('barcode_code') }}</p>
    @if(session('barcode_file'))
      <img src="{{ asset('storage/barcodes/' . session('barcode_file')) }}" 
           alt="Generated Barcode" class="mt-4 mx-auto h-24 rounded-lg shadow-lg">
    @endif
  </div>
@endif

@if(session('error'))
  <div class="mt-6 p-4 bg-red-500/30 border border-red-400 rounded-xl text-center text-white">
    {{ session('error') }}
  </div>
@endif


        </div>

      </main>

      @include('layouts.footer')
    </div>
  </div>
</body>
</html>
