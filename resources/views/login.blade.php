<!DOCTYPE html>
<html lang="en" x-data="{ showPassword: false }">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - ABSENSIKU</title>
  @vite('resources/css/app.css')
  <script src="https://unpkg.com/alpinejs" defer></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-600 via-blue-400 to-blue-200 relative overflow-hidden">

  <!-- Glow Background -->
  <div class="absolute w-60 md:w-72 h-60 md:h-72 bg-white/20 rounded-full blur-3xl top-10 left-5 md:left-20"></div>
  <div class="absolute w-80 md:w-96 h-80 md:h-96 bg-red-400/20 rounded-full blur-[110px] bottom-10 right-5 md:right-20"></div>

  <!-- Card -->
  <div class="relative backdrop-blur-xl bg-white/30 shadow-2xl border border-white/40 rounded-2xl p-6 md:p-10 w-full max-w-md">

      <!-- Logo -->
      <div class="flex flex-col items-center mb-6">
          <img 
              src="{{ asset('images/absensiku-logo.png') }}" 
              alt="ABSENSIKU Logo"
              class="w-16 h-16 md:w-20 md:h-20 object-contain drop-shadow-md"
          >
          <h1 class="text-2xl md:text-3xl font-extrabold text-white drop-shadow-md mt-3 tracking-wide">
              Selamat Datang 👋
          </h1>
          <p class="text-blue-50 text-sm">Masuk untuk melanjutkan ke dashboard</p>
      </div>

      @if ($errors->any())
      <div 
          x-data="{ show: true }" 
          x-show="show"
          x-transition.opacity.duration.300ms
          x-init="setTimeout(() => show = false, 3000)"
          class="mb-4 p-3 rounded-xl bg-red-200/70 border border-red-300 text-red-700 text-sm"
      >
          {{ $errors->first() }}
      </div>
      @endif

      <!-- Form -->
      <form action="{{ route('authenticate') }}" method="POST" class="space-y-6">
          @csrf

          <!-- Email -->
          <div>
              <label class="text-white text-sm font-semibold">Email</label>
              <input 
                  type="email"
                  name="email"
                  class="w-full mt-1 px-4 py-3 rounded-xl bg-white/50 border border-white/60 backdrop-blur-lg focus:ring-2 focus:ring-blue-500 outline-none"
                  placeholder="nama@email.com"
                  required
              />
          </div>

          <!-- Password -->
          <div>
              <label class="text-white text-sm font-semibold">Password</label>
              <div class="relative mt-1">
                  <input 
                      :type="showPassword ? 'text' : 'password'"
                      name="password"
                      class="w-full px-4 py-3 rounded-xl bg-white/50 border border-white/60 backdrop-blur-lg focus:ring-2 focus:ring-blue-500 outline-none"
                      placeholder="••••••••"
                      required
                  />

                  <!-- Toggle Password (fixed center) -->
                  <button 
                      type="button"
                      @click="showPassword = !showPassword"
                      class="absolute right-3 top-1/2 -translate-y-1/2 text-blue-700/60 hover:text-red-500 transition"
                  >
                      <!-- Eye Off -->
                      <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3l18 18m-2.121-2.121A9.969 9.969 0 0112 19c-4.477 0-8.269-2.943-9.543-7a9.964 9.964 0 012.155-3.467m3.323-2.007A9.969 9.969 0 0112 5c4.477 0 8.269 2.943 9.543 7a9.967 9.967 0 01-4.584 5.818" />
                      </svg>

                      <!-- Eye -->
                      <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                      </svg>
                  </button>
              </div>
          </div>

          <!-- Submit -->
          <button 
              type="submit"
              class="w-full py-3 rounded-xl bg-gradient-to-r from-blue-600 to-red-500 text-white font-semibold shadow-lg hover:scale-[1.02] transition-transform"
          >
              Masuk
          </button>
      </form>

      <p class="text-center text-sm text-white/90 mt-6">
          Belum punya akun?
          <a href="/register" class="font-semibold text-white hover:text-red-400 transition">
              Daftar Sekarang
          </a>
      </p>

      <div class="text-center text-xs text-white/70 mt-6 border-t border-white/30 pt-3">
          © 2025 - ABSENSIKU
      </div>

  </div>

</body>
</html>
