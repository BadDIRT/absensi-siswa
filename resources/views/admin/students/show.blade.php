<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Siswa</title>
  @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex flex-col bg-gradient-to-br from-blue-400 to-blue-600 text-white">

  <header class="p-4 flex justify-between items-center bg-white/20 backdrop-blur-xl border-b border-white/20">
    <h1 class="text-2xl font-bold">Detail Siswa</h1>
    <a href="{{ route('students.index') }}" class="bg-gray-500/60 px-4 py-2 rounded-lg hover:bg-gray-500 transition">Kembali</a>
  </header>

  <main class="flex-1 p-6 flex justify-center items-center">
    <div class="bg-white/20 backdrop-blur-xl rounded-2xl p-8 shadow-lg max-w-lg w-full space-y-3">
      <h2 class="text-xl font-bold mb-4 border-b border-white/30 pb-2">{{ $student->name }}</h2>

      <p><strong>Jenis Kelamin:</strong> {{ $student->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
      <p><strong>Tanggal Lahir:</strong> {{ $student->date_of_birth }}</p>
      <p><strong>NISN:</strong> {{ $student->nisn }}</p>
      <p><strong>NIPD:</strong> {{ $student->nipd }}</p>
      <p><strong>Kelas:</strong> {{ $student->class->grade ?? '-' }}</p>
      <p><strong>Jurusan:</strong> {{ $student->department->name ?? '-' }}</p>

      <div class="flex gap-2 mt-4">
        <a href="{{ route('students.edit', $student->id) }}" class="bg-yellow-500 hover:bg-yellow-600 px-4 py-2 rounded-xl">Edit</a>
        <form method="POST" action="{{ route('students.destroy', $student->id) }}" onsubmit="return confirm('Hapus data ini?')">
          @csrf
          @method('DELETE')
          <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-xl">Hapus</button>
        </form>
      </div>
    </div>
  </main>

  <footer class="text-center py-3 text-white/70 bg-white/10 border-t border-white/20">© {{ date('Y') }} ABSENSIKU</footer>

</body>
</html>
