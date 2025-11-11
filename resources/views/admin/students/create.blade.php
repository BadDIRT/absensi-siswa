<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tambah Data Siswa</title>
  <script src="https://unpkg.com/alpinejs" defer></script>
  @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex flex-col bg-gradient-to-br from-blue-400 to-blue-600 text-white">

  <header class="p-4 flex justify-between items-center bg-white/20 backdrop-blur-xl border-b border-white/20">
    <h1 class="text-2xl font-bold">Tambah Data Siswa</h1>
    <a href="{{ route('students.index') }}" class="bg-gray-500/60 px-4 py-2 rounded-lg hover:bg-gray-500 transition">Kembali</a>
  </header>

  <main class="flex-1 p-6">
    <div class="max-w-xl mx-auto bg-white/20 backdrop-blur-xl rounded-2xl p-6 shadow-lg">
      <form method="POST" action="{{ route('students.store') }}" class="space-y-4">
        @csrf

        <div>
          <label class="block mb-1 font-semibold">Nama Siswa</label>
          <input type="text" name="name" value="{{ old('name') }}" required class="w-full p-2 rounded text-black">
        </div>

        <div>
          <label class="block mb-1 font-semibold">Jenis Kelamin</label>
          <select name="gender" required class="w-full p-2 rounded text-black">
            <option value="">-- Pilih --</option>
            <option value="L" {{ old('gender')=='L'?'selected':'' }}>Laki-laki</option>
            <option value="P" {{ old('gender')=='P'?'selected':'' }}>Perempuan</option>
          </select>
        </div>

        <div>
          <label class="block mb-1 font-semibold">Tanggal Lahir</label>
          <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" required class="w-full p-2 rounded text-black">
        </div>

        <div>
          <label class="block mb-1 font-semibold">NISN</label>
          <input type="text" name="nisn" value="{{ old('nisn') }}" required class="w-full p-2 rounded text-black">
        </div>

        <div>
          <label class="block mb-1 font-semibold">NIPD</label>
          <input type="text" name="nipd" value="{{ old('nipd') }}" required class="w-full p-2 rounded text-black">
        </div>

        <div>
          <label class="block mb-1 font-semibold">Kelas</label>
          <select name="class_id" required class="w-full p-2 rounded text-black">
            <option value="">-- Pilih Kelas --</option>
            @foreach($classes as $c)
              <option value="{{ $c->id }}">{{ $c->grade }}</option>
            @endforeach
          </select>
        </div>

        <div>
          <label class="block mb-1 font-semibold">Jurusan</label>
          <select name="department_id" required class="w-full p-2 rounded text-black">
            <option value="">-- Pilih Jurusan --</option>
            @foreach($departments as $d)
              <option value="{{ $d->id }}">{{ $d->name }}</option>
            @endforeach
          </select>
        </div>

        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 py-2 rounded-xl font-semibold mt-4">Simpan</button>
      </form>
    </div>
  </main>

  <footer class="text-center py-3 text-white/70 bg-white/10 border-t border-white/20">© {{ date('Y') }} ABSENSIKU</footer>

</body>
</html>
