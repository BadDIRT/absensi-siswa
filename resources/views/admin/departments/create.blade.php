<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ABSENSIKU - Tambah Jurusan</title>

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

        <!-- SIDEBAR MENU -->
        @include('layouts.sidebarMenu')

    <!-- MAIN -->
    <div class="flex-1 flex flex-col transition-all duration-300">

      <!-- HEADER -->
      <header 
        class="sticky top-0 z-40 w-full bg-white/20 backdrop-blur-xl border-b border-white/20 shadow-lg 
               p-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
          <button @click="sidebarOpen = !sidebarOpen" class="text-white text-2xl font-bold">☰</button>
          <img src="/images/absensiku-logo.png" class="hidden lg:block w-10 h-10 drop-shadow-xl">
          <h1 class="text-2xl font-bold text-white drop-shadow">Tambah Jurusan</h1>
        </div>

        <a href="{{ route('departments.index') }}" 
          class="px-4 py-2 backdrop-blur-lg hover:scale-105 hover:shadow-lg 
                 text-white rounded-xl transition-all duration-300 font-semibold">
           Kembali
        </a>
      </header>

      <!-- FORM -->
      <main class="p-6 flex-1 mt-4">
        <div class="bg-white/30 backdrop-blur-xl border border-white/20 rounded-2xl shadow-xl p-8 max-w-2xl mx-auto text-white transition-all duration-300 hover:shadow-2xl">
          <h2 class="text-3xl font-bold mb-8 text-center">Form Tambah Jurusan</h2>

          <form method="POST" action="{{ route('departments.store') }}" class="space-y-5">
            @csrf

            <!-- Nama Jurusan -->
            <div>
              <label class="block mb-2 font-semibold">Nama Jurusan</label>
              <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama jurusan" class="w-full p-3 rounded-xl bg-white/40 border border-white/60 text-black placeholder-gray-600 focus:ring-2 focus:ring-indigo-500 focus:scale-[1.02] transition">
              @error('name') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Kode Jurusan -->
            <div>
              <label class="block mb-2 font-semibold">Kode Jurusan</label>
              <input type="text" name="code" value="{{ old('code') }}" placeholder="Contoh: RPL, TKJ, DKV..." class="w-full p-3 rounded-xl bg-white/40 border border-white/60 text-black placeholder-gray-600 focus:ring-2 focus:ring-indigo-500 focus:scale-[1.02] transition">
              @error('code') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Deskripsi -->
            <div>
              <label class="block mb-2 font-semibold">Deskripsi Jurusan</label>
              <textarea name="description" rows="4" placeholder="Tuliskan deskripsi singkat tentang jurusan ini..." class="w-full p-3 rounded-xl bg-white/40 border border-white/60 text-black placeholder-gray-600 focus:ring-2 focus:ring-indigo-500 focus:scale-[1.02] transition">{{ old('description') }}</textarea>
              @error('description') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full py-3 mt-4 bg-gradient-to-r  from-blue-600 to-red-500 text-white rounded-xl font-semibold shadow-lg hover:scale-[1.04] active:scale-95 transition-transform">
              Simpan Jurusan
            </button>
          </form>
        </div>
      </main>

      @include('layouts.footer')
    </div>
  </div>
</body>
</html>
