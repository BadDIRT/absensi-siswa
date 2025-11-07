<!DOCTYPE html>
<html lang="en" x-data="{ showPassword: false }">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register - ABSENSIKU</title>
  @vite('resources/css/app.css')
  <script src="https://unpkg.com/alpinejs" defer></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-600 via-blue-400 to-blue-200 relative overflow-hidden">

  <!-- Glow Background Animated -->
  <div class="absolute w-60 md:w-72 h-60 md:h-72 bg-white/20 rounded-full blur-3xl top-10 left-5 md:left-20 animate-pulse slow"></div>
  <div class="absolute w-80 md:w-96 h-80 md:h-96 bg-red-400/20 rounded-full blur-[110px] bottom-10 right-5 md:right-20 animate-float"></div>

  <!-- Card -->
  <div class="relative backdrop-blur-xl bg-white/30 shadow-2xl border border-white/40 rounded-2xl p-6 md:p-10 w-full max-w-md transform animate-fadeIn">

      <!-- Logo -->
      <div class="flex flex-col items-center mb-6 animate-slideDown">
          <img 
              src="{{ asset('images/absensiku-logo.png') }}" 
              alt="ABSENSIKU Logo"
              class="w-16 h-16 md:w-20 md:h-20 object-contain drop-shadow-md animate-pop"
          >
          <h1 class="text-2xl md:text-3xl font-extrabold text-white drop-shadow-md mt-3 tracking-wide">
              Daftar Akun ✨
          </h1>
          <p class="text-blue-50 text-sm">Isi data di bawah untuk membuat akun baru</p>
      </div>

      <!-- Error Global -->
      @if ($errors->any())
      <div 
          x-data="{ show:true }"
          x-show="show"
          x-transition.opacity.duration.400ms
          x-init="setTimeout(()=>show=false,3000)"
          class="mb-4 p-3 rounded-xl bg-red-200/70 border border-red-300 text-red-700 text-sm shadow-md animate-shake"
      >
          Terdapat kesalahan, periksa kembali formulir anda.
      </div>
      @endif

      <!-- Form -->
      <form action="{{ route('register.process') }}" method="POST" class="space-y-6 animate-slideUp">
          @csrf

          <!-- Nama -->
          <div>
              <label class="text-white text-sm font-semibold">Nama Lengkap</label>
              <input 
                  type="text"
                  name="name"
                  value="{{ old('name') }}"
                  class="w-full mt-1 px-4 py-3 rounded-xl bg-white/50 border border-white/60 backdrop-blur-lg focus:ring-2 focus:ring-blue-500 outline-none transition-transform focus:scale-[1.02]"
                  placeholder="Nama lengkap anda"
                  required
              />
              @error('name')
              <p class="text-red-200 text-sm mt-1">{{ $message }}</p>
              @enderror
          </div>

          <!-- Email -->
          <div>
              <label class="text-white text-sm font-semibold">Email</label>
              <input 
                  type="email"
                  name="email"
                  value="{{ old('email') }}"
                  class="w-full mt-1 px-4 py-3 rounded-xl bg-white/50 border border-white/60 backdrop-blur-lg focus:ring-2 focus:ring-blue-500 outline-none transition-transform focus:scale-[1.02]"
                  placeholder="email@example.com"
                  required
              />
              @error('email')
              <p class="text-red-200 text-sm mt-1">{{ $message }}</p>
              @enderror
          </div>

          <!-- Password -->
          <div>
              <label class="text-white text-sm font-semibold">Password</label>
              <div class="relative mt-1">
                  <input 
                      :type="showPassword ? 'text' : 'password'"
                      name="password"
                      class="w-full px-4 py-3 rounded-xl bg-white/50 border border-white/60 backdrop-blur-lg focus:ring-2 focus:ring-blue-500 outline-none transition-transform focus:scale-[1.02]"
                      placeholder="Minimal 8 karakter"
                      required
                  />

                  <!-- Toggle -->
<button 
    type="button"
    @click="showPassword = !showPassword"
    class="absolute right-3 top-1/2 -translate-y-1/2 text-blue-700/60 hover:text-red-500 transition animate-pop"
>
    <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18m-2.121-2.121A9.969 9.969 0 0112 19c-4.477 0-8.269-2.943-9.543-7a9.964 9.964 0 012.155-3.467m3.323-2.007A9.969 9.969 0 0112 5c4.477 0 8.269 2.943 9.543 7a9.967 9.967 0 01-4.584 5.818"/>
    </svg>

    <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
    </svg>
</button>

              </div>
              @error('password')
              <p class="text-red-200 text-sm mt-1">{{ $message }}</p>
              @enderror
          </div>

          <!-- Submit -->
          <button 
              type="submit"
              class="w-full py-3 rounded-xl bg-gradient-to-r from-blue-600 to-red-500 text-white font-semibold shadow-lg hover:scale-[1.04] active:scale-95 transition-transform"
          >
              Buat Akun
          </button>
      </form>

      <!-- Link ke login -->
      <p class="text-center text-sm text-white/90 mt-6 animate-fadeIn">
          Sudah punya akun?
          <a href="{{ route('login') }}" class="font-semibold text-white hover:text-red-400 transition">
              Masuk Sekarang
          </a>
      </p>

      <div class="text-center text-xs text-white/70 mt-6 border-t border-white/30 pt-3 animate-fadeIn slow">
          © 2025 - ABSENSIKU
      </div>

  </div>

<!-- Animations -->
<style>
  .animate-fadeIn { animation: fadeIn 0.7s ease-out; }
  .animate-slideDown { animation: slideDown 0.8s ease-out; }
  .animate-slideUp { animation: slideUp 0.8s ease-out; }
  .animate-pop { animation: pop 0.5s ease-out; }
  .animate-shake { animation: shake 0.4s ease-in-out; }
  .animate-float { animation: float 6s ease-in-out infinite; }
  .slow { animation-duration: 3s; }

  @keyframes fadeIn { from { opacity:0; transform:translateY(10px);} to { opacity:1; transform:translateY(0);} }
  @keyframes slideDown { from { opacity:0; transform:translateY(-20px);} to { opacity:1; transform:translateY(0);} }
  @keyframes slideUp { from { opacity:0; transform:translateY(20px);} to { opacity:1; transform:translateY(0);} }
  @keyframes pop { 0% { transform:scale(0.8); opacity:0;} 100% { transform:scale(1); opacity:1;} }
  @keyframes shake { 0%,100%{ transform:translateX(0);} 20%{ transform:translateX(-5px);} 40%{ transform:translateX(5px);} 60%{ transform:translateX(-5px);} 80%{ transform:translateX(5px);} }
  @keyframes float { 0%,100% { transform:translateY(0);} 50% { transform:translateY(-20px);} }
</style>

</body>
</html>
