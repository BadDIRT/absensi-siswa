<!-- ✅ Sidebar Menu -->
        <nav class="mt-8 space-y-3 text-white font-semibold">

          <!-- DASHBOARD -->
          <a href="{{ route('admin.dashboard') }}" 
             class="block px-4 py-2 rounded-xl 
                    {{ request()->routeIs('admin.dashboard') 
                        ? 'bg-gradient-to-r from-blue-500/70 to-indigo-500/70 text-white shadow-lg' 
                        : 'bg-white/10 text-white/80 hover:bg-gradient-to-r hover:from-blue-400/40 hover:to-indigo-400/40 hover:text-white' }}
                    transition-all duration-300 ease-out transform hover:scale-105">
            🏠 Dashboard
          </a>

          <!-- REKAP ABSEN -->
          <a href="{{ route('attendances.index') }}" 
             class="block px-4 py-2 rounded-xl 
                    {{ request()->routeIs('attendances.*') 
                        ? 'bg-gradient-to-r from-blue-500/70 to-indigo-500/70 text-white shadow-lg' 
                        : 'bg-white/10 text-white/80 hover:bg-gradient-to-r hover:from-blue-400/40 hover:to-indigo-400/40 hover:text-white' }}
                    transition-all duration-300 ease-out transform hover:scale-105">
            📋 Rekap Absen
          </a>

          <!-- DATA SISWA -->
          <a href="{{ route('students.index') }}" 
             class="block px-4 py-2 rounded-xl 
                    {{ request()->routeIs('students.*') 
                        ? 'bg-gradient-to-r from-blue-500/70 to-indigo-500/70 text-white shadow-lg' 
                        : 'bg-white/10 text-white/80 hover:bg-gradient-to-r hover:from-blue-400/40 hover:to-indigo-400/40 hover:text-white' }}
                    transition-all duration-300 ease-out transform hover:scale-105">
            👨‍🎓 Data Siswa/i
          </a>

          <!-- DATA GURU -->
          <a href="{{ route('teachers.index') }}" 
             class="block px-4 py-2 rounded-xl 
                    {{ request()->routeIs('teachers.*') 
                        ? 'bg-gradient-to-r from-blue-500/70 to-indigo-500/70 text-white shadow-lg' 
                        : 'bg-white/10 text-white/80 hover:bg-gradient-to-r hover:from-blue-400/40 hover:to-indigo-400/40 hover:text-white' }}
                    transition-all duration-300 ease-out transform hover:scale-105">
            👨‍🏫 Data Guru
          </a>

          <!-- DATA KELAS -->
          <a href="{{ route('classes.index') }}" 
             class="block px-4 py-2 rounded-xl 
                    {{ request()->routeIs('classes.*') 
                        ? 'bg-gradient-to-r from-blue-500/70 to-indigo-500/70 text-white shadow-lg' 
                        : 'bg-white/10 text-white/80 hover:bg-gradient-to-r hover:from-blue-400/40 hover:to-indigo-400/40 hover:text-white' }}
                    transition-all duration-300 ease-out transform hover:scale-105">
            🏫 Data Kelas
          </a>

          <!-- DATA JURUSAN -->
          <a href="{{ route('departments.index') }}" 
             class="block px-4 py-2 rounded-xl 
                    {{ request()->routeIs('departments.*') 
                        ? 'bg-gradient-to-r from-blue-500/70 to-indigo-500/70 text-white shadow-lg' 
                        : 'bg-white/10 text-white/80 hover:bg-gradient-to-r hover:from-blue-400/40 hover:to-indigo-400/40 hover:text-white' }}
                    transition-all duration-300 ease-out transform hover:scale-105">
            🧩 Data Jurusan
          </a>

          <!-- DATA MATA PELAJARAN -->
          <a href="{{ route('subjects.index') }}" 
             class="block px-4 py-2 rounded-xl 
                    {{ request()->routeIs('attendances.*') 
                        ? 'bg-gradient-to-r from-blue-500/70 to-indigo-500/70 text-white shadow-lg' 
                        : 'bg-white/10 text-white/80 hover:bg-gradient-to-r hover:from-blue-400/40 hover:to-indigo-400/40 hover:text-white' }}
                    transition-all duration-300 ease-out transform hover:scale-105">
             📚 Data Mata Pelajaran
          </a>

          <!-- DATA JADWAL -->
          <a href="{{ route('timetables.index') }}" 
             class="block px-4 py-2 rounded-xl 
                    {{ request()->routeIs('timetables.*') 
                        ? 'bg-gradient-to-r from-blue-500/70 to-indigo-500/70 text-white shadow-lg' 
                        : 'bg-white/10 text-white/80 hover:bg-gradient-to-r hover:from-blue-400/40 hover:to-indigo-400/40 hover:text-white' }}
                    transition-all duration-300 ease-out transform hover:scale-105">
             ⏱️ Data Jadwal
          </a>

          <!-- PENGATURAN -->
          <a href="#" 
             class="block px-4 py-2 rounded-xl 
                    bg-white/10 text-white/80 hover:bg-gradient-to-r hover:from-blue-400/40 hover:to-indigo-400/40 hover:text-white 
                    transition-all duration-300 ease-out transform hover:scale-105">
            ⚙️ Pengaturan
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
            Keluar
          </button>
        </form>
      </div>
    </aside>