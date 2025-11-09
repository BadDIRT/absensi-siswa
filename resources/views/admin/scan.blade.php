<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ABSENSIKU - Scan Barcode</title>

  <script src="https://unpkg.com/alpinejs" defer></script>
  @vite('resources/css/app.css')
  <script src="https://unpkg.com/html5-qrcode"></script>

  <style>
    .slide {
      transition: transform 0.3s ease, opacity 0.3s ease;
    }
    select {
      color: #1e3a8a !important;
      background-color: rgba(255, 255, 255, 0.8) !important;
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

        <!-- ✅ NAVIGATION FIXED -->
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

    <!-- WRAPPER UTAMA -->
    <div class="flex-1 flex flex-col transition-all duration-300">

      <!-- HEADER -->
      <header 
        class="sticky top-0 z-40 w-full bg-white/20 backdrop-blur-xl border-b border-white/20 shadow-lg 
               p-4 flex items-center justify-between">
        
        <div class="flex items-center gap-3">
          <button @click="sidebarOpen = !sidebarOpen" class="text-white text-2xl font-bold">☰</button>
          <img src="/images/absensiku-logo.png" class="hidden lg:block w-10 h-10 drop-shadow-xl">
          <h1 class="text-2xl font-bold text-white drop-shadow">Scan Barcode</h1>
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
          <h2 class="text-2xl font-bold text-white mb-3">Scan Barcode Siswa</h2>
          <p class="text-white/80 mb-6">Arahkan kamera ke barcode siswa untuk mencatat kehadiran secara otomatis.</p>

          <div id="reader" class="rounded-2xl overflow-hidden border border-white/20 shadow-lg w-full"></div>
          <div id="scan-status" class="mt-6 text-sm text-white/70 italic">Menunggu hasil scan...</div>
        </div>
      </main>

      @include('layouts.footer')
    </div>
  </div>

  <script>
    const statusElem = document.getElementById('scan-status');

    function onScanSuccess(decodedText) {
      statusElem.textContent = "Barcode terbaca! Mengirim data...";
      fetch('{{ route('barcode.validate') }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ nipd: decodedText })
      })
      .then(res => res.json())
      .then(data => {
        statusElem.textContent = data.message;
        statusElem.classList.remove('text-white/70');
        statusElem.classList.add(data.success ? 'text-green-300' : 'text-red-300');
      })
      .catch(err => {
        console.error(err);
        statusElem.textContent = "Terjadi kesalahan saat memproses data.";
        statusElem.classList.add('text-red-400');
      });
    }

    const html5QrcodeScanner = new Html5QrcodeScanner(
      "reader",
      {
        fps: 10,
        qrbox: { width: 250, height: 250 },
        aspectRatio: 1.0
      },
      false
    );
    html5QrcodeScanner.render(onScanSuccess);
  </script>
</body>
</html>
