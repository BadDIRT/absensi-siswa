<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ABSENSIKU - Tambah Siswa</title>

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

    <!-- ✅ SIDEBAR -->
    <aside
      class="fixed inset-y-0 left-0 w-64 bg-white/30 backdrop-blur-xl shadow-xl border-r border-white/20
             z-50 transform transition-all duration-300 flex flex-col justify-between"
      :class="sidebarOpen ? 'translate-x-0 opacity-100' : '-translate-x-64 opacity-0'">

      <div class="p-6">
        <div class="flex items-center gap-3">
          <img src="/images/absensiku-logo.png" class="w-10 h-10 drop-shadow-xl">
          <h2 class="text-2xl font-bold text-white drop-shadow">ABSENSIKU</h2>
        </div>

        <!-- Sidebar Menu -->
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

      <!-- Logout -->
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

    <!-- ✅ MAIN -->
    <div class="flex-1 flex flex-col transition-all duration-300">
      
      <!-- HEADER -->
      <header 
        class="sticky top-0 z-40 w-full bg-white/20 backdrop-blur-xl border-b border-white/20 shadow-lg 
               p-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
          <button @click="sidebarOpen = !sidebarOpen" class="text-white text-2xl font-bold">☰</button>
          <img src="/images/absensiku-logo.png" class="hidden lg:block w-10 h-10 drop-shadow-xl">
          <h1 class="text-2xl font-bold text-white drop-shadow">Tambah Siswa</h1>
        </div>

        <a href="{{ route('students.index') }}" 
          class="px-4 py-2 bg-gradient-to-r from-blue-400/70 to-indigo-700/70 
                 hover:from-gray-500 hover:to-gray-600 hover:scale-105 hover:shadow-lg 
                 text-white rounded-xl transition-all duration-300 font-semibold">
           Kembali
        </a>
      </header>

      <!-- FORM -->
      <main class="p-6 space-y-8 flex-1 mt-4">
        <div class="bg-white/30 backdrop-blur-xl border border-white/20 rounded-2xl shadow-xl p-8 max-w-2xl mx-auto text-white animate-fadeIn">
          <h2 class="text-2xl font-bold mb-6 text-center animate-pop">Form Tambah Siswa</h2>

          <form method="POST" action="{{ route('students.store') }}" class="space-y-5 animate-slideUp">
            @csrf

            <div>
              <label class="block mb-2 font-semibold">Nama Siswa</label>
              <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" class="w-full p-3 rounded-xl bg-white/40 border border-white/60 text-black placeholder-gray-600 focus:ring-2 focus:ring-blue-500 focus:scale-[1.02] transition">
              @error('name') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
              <label class="block mb-2 font-semibold">Jenis Kelamin</label>
              <div x-data="{ open: false, selected: '{{ old('gender') ? (old('gender')=='L'?'Laki-laki':'Perempuan') : 'Pilih Jenis Kelamin' }}' }" class="relative">
                <button type="button" @click="open = !open" class="w-full p-3 bg-white/50 border border-white/40 rounded-xl text-gray-800 flex justify-between items-center hover:bg-white/70 focus:ring-2 focus:ring-blue-400 focus:scale-[1.02] transition">
                  <span x-text="selected"></span>
                  <span :class="open ? 'rotate-180' : ''" class="transition-transform">▼</span>
                </button>
                <div x-show="open" @click.away="open=false" x-transition class="absolute z-50 mt-2 w-full bg-white/90 rounded-xl shadow-lg backdrop-blur-md text-gray-800">
                  <div @click="selected='Laki-laki'; open=false; $refs.gender.value='L'" class="px-4 py-2 hover:bg-blue-100 rounded-t-xl cursor-pointer">Laki-laki</div>
                  <div @click="selected='Perempuan'; open=false; $refs.gender.value='P'" class="px-4 py-2 hover:bg-blue-100 rounded-b-xl cursor-pointer">Perempuan</div>
                </div>
                <input type="hidden" x-ref="gender" name="gender" value="{{ old('gender') }}">
              </div>
              @error('gender') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
              <label class="block mb-2 font-semibold">Tanggal Lahir</label>
              <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="w-full p-3 rounded-xl bg-white/40 border border-white/60 text-black focus:ring-2 focus:ring-blue-500 focus:scale-[1.02] transition">
              @error('date_of_birth') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block mb-2 font-semibold">NISN</label>
                <input type="text" name="nisn" value="{{ old('nisn') }}" placeholder="Masukkan NISN" class="w-full p-3 rounded-xl bg-white/40 border border-white/60 text-black placeholder-gray-600 focus:ring-2 focus:ring-blue-500 focus:scale-[1.02] transition">
                @error('nisn') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
              </div>

              <div>
                <label class="block mb-2 font-semibold">NIPD</label>
                <input type="text" name="nipd" value="{{ old('nipd') }}" placeholder="Masukkan NIPD" class="w-full p-3 rounded-xl bg-white/40 border border-white/60 text-black placeholder-gray-600 focus:ring-2 focus:ring-blue-500 focus:scale-[1.02] transition">
                @error('nipd') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
              </div>
            </div>

            <div>
              <label class="block mb-2 font-semibold">Alamat</label>
              <textarea name="address" rows="3" placeholder="Masukkan alamat lengkap siswa" class="w-full p-3 rounded-xl bg-white/40 border border-white/60 text-black placeholder-gray-600 focus:ring-2 focus:ring-blue-500 focus:scale-[1.02] transition">{{ old('address') }}</textarea>
              @error('address') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- CUSTOM DROPDOWN KELAS -->
            <div x-data="{ open: false, selected: '{{ old('class_id') ? $classes->firstWhere('id', old('class_id'))->grade : 'Pilih Kelas' }}' }" class="relative">
              <label class="block mb-2 font-semibold">Kelas</label>
              <button type="button" @click="open = !open" class="w-full p-3 bg-white/50 border border-white/40 rounded-xl text-gray-800 flex justify-between items-center hover:bg-white/70 focus:ring-2 focus:ring-blue-400 focus:scale-[1.02] transition">
                <span x-text="selected"></span>
                <span :class="open ? 'rotate-180' : ''" class="transition-transform">▼</span>
              </button>
              <div x-show="open" @click.away="open=false" x-transition class="absolute z-50 mt-2 w-full bg-white/90 rounded-xl shadow-lg backdrop-blur-md text-gray-800 max-h-48 overflow-y-auto">
                @foreach($classes as $class)
                  <div @click="selected='{{ $class->grade }}'; open=false; $refs.class_id.value='{{ $class->id }}'" class="px-4 py-2 hover:bg-blue-100 cursor-pointer">{{ $class->grade }}</div>
                @endforeach
              </div>
              <input type="hidden" x-ref="class_id" name="class_id" value="{{ old('class_id') }}">
              @error('class_id') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- CUSTOM DROPDOWN JURUSAN -->
            <div x-data="{ open: false, selected: '{{ old('department_id') ? $departments->firstWhere('id', old('department_id'))->name : 'Pilih Jurusan' }}' }" class="relative">
              <label class="block mb-2 font-semibold">Jurusan</label>
              <button type="button" @click="open = !open" class="w-full p-3 bg-white/50 border border-white/40 rounded-xl text-gray-800 flex justify-between items-center hover:bg-white/70 focus:ring-2 focus:ring-indigo-400 focus:scale-[1.02] transition">
                <span x-text="selected"></span>
                <span :class="open ? 'rotate-180' : ''" class="transition-transform">▼</span>
              </button>
              <div x-show="open" @click.away="open=false" x-transition class="absolute z-50 mt-2 w-full bg-white/90 rounded-xl shadow-lg backdrop-blur-md text-gray-800 max-h-48 overflow-y-auto">
                @foreach($departments as $d)
                  <div @click="selected='{{ $d->name }}'; open=false; $refs.department_id.value='{{ $d->id }}'" class="px-4 py-2 hover:bg-indigo-100 cursor-pointer">{{ $d->name }}</div>
                @endforeach
              </div>
              <input type="hidden" x-ref="department_id" name="department_id" value="{{ old('department_id') }}">
              @error('department_id') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full py-3 mt-4 bg-gradient-to-r from-blue-600 to-indigo-500 text-white rounded-xl font-semibold shadow-lg hover:scale-[1.04] active:scale-95 transition-transform">
              Simpan Data
            </button>
          </form>
        </div>
      </main>

      @include('layouts.footer')
    </div>
  </div>
</body>
</html>
