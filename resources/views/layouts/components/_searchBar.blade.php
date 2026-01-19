<!-- SEARCH BAR -->
    <div class="relative">
        <input type="text" name="search" value="{{ request('search') }}"
               class="w-full px-4 py-3 rounded-xl bg-white/20 text-white placeholder-white/70 border border-white/30
                      focus:ring-2 focus:ring-white/40 focus:bg-white/30 transition-all duration-300"
               placeholder="Pencarian...">

        <svg class="w-5 h-5 absolute right-4 top-1/2 -translate-y-1/2 text-white/60"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m21 21-5.2-5.2m2.2-5.3a7.5 7.5 0 1 1-15.001 0A7.5 7.5 0 0 1 18 10.5Z" />
        </svg>
    </div>