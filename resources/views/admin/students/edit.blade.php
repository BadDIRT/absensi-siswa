<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ABSENSIKU - Edit Siswa/i</title>

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
          <h1 class="text-2xl font-bold text-white drop-shadow">Edit Data Siswa/i</h1>
        </div>

        <a href="{{ route('students.index') }}" 
          class="px-4 py-2 backdrop-blur-lg 
                hover:scale-105 hover:shadow-lg 
                 text-white rounded-xl transition-all duration-300 font-semibold">
          Kembali
        </a>
      </header>

      <!-- FORM -->
      <main class="p-6 flex-1 mt-4">
        <div class="bg-white/30 backdrop-blur-xl border border-white/20 rounded-2xl shadow-xl p-8 max-w-2xl mx-auto text-white">
          <h2 class="text-2xl font-bold mb-6 text-center">Form Edit Siswa/i</h2>

          <form method="POST" action="{{ route('students.update', $student->id) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
              <label class="block mb-2 font-semibold">Nama Siswa/i</label>
              <input type="text" name="name" value="{{ old('name', $student->name) }}" placeholder="Masukkan nama lengkap"
                class="w-full p-3 rounded-xl bg-white/40 border border-white/60 text-black placeholder-gray-600 
                       focus:ring-2 focus:ring-blue-500 focus:scale-[1.02] transition">
              @error('name') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
              <label class="block mb-2 font-semibold">Jenis Kelamin</label>
              <select name="gender"
                class="w-full p-3 rounded-xl bg-white/40 border border-white/60 text-black focus:ring-2 focus:ring-blue-500 focus:scale-[1.02] transition">
                <option value="L" {{ old('gender', $student->gender) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ old('gender', $student->gender) == 'P' ? 'selected' : '' }}>Perempuan</option>
              </select>
              @error('gender') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
              <label class="block mb-2 font-semibold">Tanggal Lahir</label>
              <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $student->date_of_birth) }}" 
                     class="w-full p-3 rounded-xl bg-white/40 border border-white/60 text-black focus:ring-2 focus:ring-blue-500 focus:scale-[1.02] transition">
              @error('date_of_birth') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block mb-2 font-semibold">NISN</label>
                <input type="text" name="nisn" value="{{ old('nisn', $student->nisn) }}" 
                       class="w-full p-3 rounded-xl bg-white/40 border border-white/60 text-black placeholder-gray-600 focus:ring-2 focus:ring-blue-500 focus:scale-[1.02] transition">
                @error('nisn') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
              </div>

              <div>
                <label class="block mb-2 font-semibold">NIPD</label>
                <input type="text" name="nipd" value="{{ old('nipd', $student->nipd) }}" 
                       class="w-full p-3 rounded-xl bg-white/40 border border-white/60 text-black placeholder-gray-600 focus:ring-2 focus:ring-blue-500 focus:scale-[1.02] transition">
                @error('nipd') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
              </div>
            </div>

            <div>
              <label class="block mb-2 font-semibold">Alamat</label>
              <textarea name="address" rows="3" placeholder="Masukkan alamat lengkap siswa" 
                        class="w-full p-3 rounded-xl bg-white/40 border border-white/60 text-black placeholder-gray-600 focus:ring-2 focus:ring-blue-500 focus:scale-[1.02] transition">{{ old('address', $student->address) }}</textarea>
              @error('address') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
              <label class="block mb-2 font-semibold">Kelas</label>
              <select name="class_id" class="w-full p-3 rounded-xl bg-white/40 border border-white/60 text-black focus:ring-2 focus:ring-blue-500 focus:scale-[1.02] transition">
                @foreach($classes as $class)
                  <option value="{{ $class->id }}" {{ old('class_id', $student->class_id) == $class->id ? 'selected' : '' }}>
                    {{ $class->grade }}
                  </option>
                @endforeach
              </select>
              @error('class_id') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
              <label class="block mb-2 font-semibold">Jurusan</label>
              <select name="department_id" class="w-full p-3 rounded-xl bg-white/40 border border-white/60 text-black focus:ring-2 focus:ring-blue-500 focus:scale-[1.02] transition">
                @foreach($departments as $dept)
                  <option value="{{ $dept->id }}" {{ old('department_id', $student->department_id) == $dept->id ? 'selected' : '' }}>
                    {{ $dept->name }}
                  </option>
                @endforeach
              </select>
              @error('department_id') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" 
              class="w-full py-3 mt-6 bg-gradient-to-r from-blue-600/90 to-red-500/90 text-white rounded-xl font-semibold shadow-lg hover:scale-[1.04] hover:shadow-xl active:scale-95 transition-transform">
              Simpan Perubahan
            </button>
          </form>
        </div>
      </main>

      @include('layouts.footer')
    </div>
  </div>
</body>
</html>
