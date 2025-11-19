<!-- ALERT -->
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition
                     class="mx-2 sm:mx-6 mt-4 flex items-center justify-between bg-green-500/20 backdrop-blur-xl text-white font-semibold px-4 sm:px-6 py-3 rounded-xl shadow-xl border border-white/20">

                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12l2 2l4-4m5 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="hover:text-white/80 transition">✕</button>
                </div>
            @endif