<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ABSENSIKU - Detail Siswa/i</title>

  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.1/dist/cdn.min.js"></script>
  @vite('resources/css/app.css')

  <style>
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .fade-up {
      animation: fadeUp 0.5s ease-out forwards;
    }
  </style>
</head>

<body class="min-h-screen flex flex-col bg-gradient-to-r from-blue-600 to-red-500 text-gray-900">
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

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col transition-all duration-300">

      <!-- HEADER -->
      <header 
        class="sticky top-0 z-40 w-full bg-white/20 backdrop-blur-xl border-b border-white/20 shadow-lg 
               p-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
          <button @click="sidebarOpen = !sidebarOpen" class="text-white text-2xl font-bold">☰</button>
          <img src="/images/absensiku-logo.png" class="hidden lg:block w-10 h-10 drop-shadow-xl">
          <h1 class="text-2xl font-bold text-white drop-shadow">Detail Siswa/i</h1>
        </div>

        <a href="{{ route('students.index') }}" 
          class="px-4 py-2 backdrop-blur-xl hover:scale-105 hover:shadow-lg 
                 text-white rounded-xl transition-all duration-300 font-semibold">
          Kembali
        </a>
      </header>

      <!-- DETAIL CARD -->
      <main class="p-6 flex-1 mt-4">
        <div class="bg-white/30 backdrop-blur-xl border border-white/20 rounded-2xl shadow-xl p-8 max-w-2xl mx-auto text-white"
             x-data="{ loaded: false }"
             x-init="setTimeout(() => loaded = true, 200)">

          <h2 class="text-3xl font-bold mb-8 text-center drop-shadow-md">👤 Detail Siswa/i</h2>

          <!-- INFO LIST -->
          <div class="relative pl-6 space-y-6">
            <div class="absolute left-2 top-0 bottom-0 w-0.5 bg-white/30 rounded-full"></div>

            @php
              $fields = [
                'Nama Lengkap' => $student->name,
                'Jenis Kelamin' => $student->gender === 'L' ? 'Laki-laki' : 'Perempuan',
                'Tanggal Lahir' => \Carbon\Carbon::parse($student->date_of_birth)->translatedFormat('d F Y'),
                'NISN' => $student->nisn,
                'NIPD' => $student->nipd,
                'Kelas' => $student->class->grade ?? '-',
                'Jurusan' => $student->department->name ?? '-',
                'Alamat' => $student->address ?? '-',
              ];
            @endphp

            @foreach ($fields as $label => $value)
            <div x-show="loaded" x-transition.delay.100ms.duration.300ms class="fade-up flex items-start gap-3 relative">
              <div class="w-3 h-3 mt-1 bg-blue-400 rounded-full shadow-md ring-2 ring-white/60"></div>
              <div class="flex-1 bg-white/15 border border-white/20 rounded-xl px-4 py-3 shadow-inner">
                <p class="font-semibold text-white/90 text-sm uppercase tracking-wide">{{ $label }}</p>
                <p class="text-white/95 text-base font-medium mt-1">{{ $value }}</p>
              </div>
            </div>
            @endforeach
          </div>

          <!-- TIMESTAMP INFO -->
          <div x-show="loaded" x-transition.delay.700ms 
               class="mt-10 p-4 rounded-xl bg-white/20 border border-white/30 shadow-inner text-sm text-white/90 fade-up">
            <p><span class="font-semibold">📅 Dibuat pada:</span> {{ $student->created_at->translatedFormat('d F Y, H:i') }}</p>
            <p><span class="font-semibold">🕒 Terakhir diperbarui:</span> {{ $student->updated_at->translatedFormat('d F Y, H:i') }}</p>
          </div>

          <!-- ACTION BUTTONS -->
          <div x-show="loaded" x-transition.delay.800ms class="mt-8 flex justify-center gap-4 fade-up">
            <a href="{{ route('students.edit', $student->id) }}"
               class="px-6 py-2 bg-gradient-to-r from-yellow-400/70 to-yellow-600/70 hover:scale-105 
                      text-white rounded-xl font-semibold shadow-lg transition-all duration-300">
              Edit
            </a>

            <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus siswa ini?')">
              @csrf
              @method('DELETE')
              <button class="px-6 py-2 bg-gradient-to-r from-red-400/70 to-red-600/70 hover:scale-105 
                             text-white rounded-xl font-semibold shadow-lg transition-all duration-300">
                Hapus
              </button>
            </form>
          </div>
        </div>
      </main>

      @include('layouts.footer')
    </div>
  </div>
</body>
</html>
