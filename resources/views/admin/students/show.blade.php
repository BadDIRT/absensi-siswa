<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ABSENSIKU - Detail Siswa</title>
  <script src="https://unpkg.com/alpinejs" defer></script>
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

<body class="min-h-screen flex flex-col bg-gradient-to-br from-blue-400 to-blue-600 text-gray-900">
  <div class="flex flex-1">

    <!-- Overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" 
         x-transition.opacity class="fixed inset-0 bg-black/40 z-40"></div>

    <!-- SIDEBAR -->
    <aside :class="sidebarOpen ? 'translate-x-0 opacity-100' : '-translate-x-64 opacity-0'"
      class="fixed inset-y-0 left-0 w-64 bg-white/30 backdrop-blur-xl shadow-xl border-r border-white/20
             z-50 transform transition-all duration-300 flex flex-col justify-between">

      <div class="p-6">
        <div class="flex items-center gap-3">
          <img src="/images/absensiku-logo.png" class="w-10 h-10 drop-shadow-xl">
          <h2 class="text-2xl font-bold text-white drop-shadow">ABSENSIKU</h2>
        </div>
        <nav class="mt-8 space-y-3 text-white font-semibold">
          <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded-xl bg-white/10 hover:bg-blue-500/40 transition">🏠 Dashboard</a>
          <a href="{{ route('students.index') }}" class="block px-4 py-2 rounded-xl bg-gradient-to-r from-blue-500/70 to-indigo-500/70 text-white shadow-lg">👨‍🎓 Data Siswa</a>
          <a href="{{ route('attendances.index') }}" class="block px-4 py-2 rounded-xl bg-white/10 hover:bg-blue-500/40 transition">📋 Rekap Absen</a>
          <a href="{{ route('barcode.index') }}" class="block px-4 py-2 rounded-xl bg-white/10 hover:bg-blue-500/40 transition">⚙️ Pengaturan</a>
        </nav>
      </div>

      <div class="p-6 border-t border-white/20 bg-white/10">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="w-full px-4 py-2 bg-gradient-to-r from-red-500/70 to-red-600/70 hover:scale-105 text-white rounded-xl transition font-semibold">Logout</button>
        </form>
      </div>
    </aside>

    <!-- MAIN -->
    <div class="flex-1 flex flex-col">

      <!-- HEADER -->
      <header class="sticky top-0 z-40 w-full bg-white/20 backdrop-blur-xl border-b border-white/20 shadow-lg p-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
          <button @click="sidebarOpen = !sidebarOpen" class="text-white text-2xl font-bold">☰</button>
          <h1 class="text-2xl font-bold text-white drop-shadow">Detail Siswa</h1>
        </div>
        <a href="{{ route('students.index') }}" class="px-4 py-2 bg-gradient-to-r from-blue-400/70 to-indigo-700/70 hover:scale-105 text-white rounded-xl font-semibold transition">Kembali</a>
      </header>

      <!-- CONTENT -->
      <main class="p-6 flex-1 mt-4">
        <div class="bg-white/30 backdrop-blur-xl border border-white/20 rounded-2xl shadow-xl p-8 max-w-2xl mx-auto text-white"
             x-data="{ loaded: false }"
             x-init="setTimeout(() => loaded = true, 200)">
          
          <h2 class="text-3xl font-bold mb-8 text-center drop-shadow-md">👤 Detail Siswa</h2>

          <!-- TIMELINE INFO -->
          <div class="relative pl-6 space-y-6">
            <div class="absolute left-2 top-0 bottom-0 w-0.5 bg-white/30 rounded-full"></div>

            <template x-for="(item, index) in [
  {label: 'Nama Lengkap', value: '{{ $student->name }}'},
  {label: 'Jenis Kelamin', value: '{{ $student->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}'},
  {label: 'Tanggal Lahir', value: '{{ \Carbon\Carbon::parse($student->date_of_birth)->translatedFormat('d F Y') }}'},
  {label: 'NISN', value: '{{ $student->nisn }}'},
  {label: 'NIPD', value: '{{ $student->nipd }}'},
  {label: 'Kelas', value: '{{ $student->class->grade }}'},
  {label: 'Jurusan', value: '{{ $student->department->name }}'}
  @if($student->address)
    ,{label: 'Alamat', value: '{{ $student->address }}'}
  @endif
]" :key="index">
  <div x-show="loaded" x-transition.delay.100ms.duration.300ms
       :style="`animation-delay: ${index * 0.15}s`"
       class="fade-up flex items-start gap-3 relative">
    <div class="w-3 h-3 mt-1 bg-blue-400 rounded-full shadow-md ring-2 ring-white/60"></div>
    <div class="flex-1 bg-white/15 border border-white/20 rounded-xl px-4 py-3 shadow-inner">
      <p class="font-semibold text-white/90 text-sm uppercase tracking-wide" x-text="item.label"></p>
      <p class="text-white/95 text-base font-medium mt-1" x-text="item.value"></p>
    </div>
  </div>
</template>

          </div>

          <!-- CREATED/UPDATED -->
          <div x-show="loaded" x-transition.delay.700ms class="mt-10 p-4 rounded-xl bg-white/20 border border-white/30 shadow-inner text-sm text-white/90 fade-up">
            <p><span class="font-semibold">📅 Dibuat pada:</span> {{ $student->created_at->translatedFormat('d F Y, H:i') }}</p>
            <p><span class="font-semibold">🕒 Terakhir diperbarui:</span> {{ $student->updated_at->translatedFormat('d F Y, H:i') }}</p>
          </div>

          <!-- ACTION BUTTONS -->
          <div x-show="loaded" x-transition.delay.800ms class="mt-8 flex justify-center gap-4 fade-up">
            <a href="{{ route('students.edit', $student->id) }}"
               class="px-6 py-2 bg-gradient-to-r from-green-500 to-green-600 hover:scale-105 
                      text-white rounded-xl font-semibold shadow-lg transition-all duration-300">
              ✏️ Edit
            </a>
            <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus siswa ini?')">
              @csrf @method('DELETE')
              <button class="px-6 py-2 bg-gradient-to-r from-red-500 to-red-600 hover:scale-105 
                             text-white rounded-xl font-semibold shadow-lg transition-all duration-300">
                🗑️ Hapus
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
