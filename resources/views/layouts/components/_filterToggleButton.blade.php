<!-- FILTER TOGGLE BUTTON -->
    <button type="button"
            @click="openFilter = !openFilter"
            class="w-full px-4 py-3 flex items-center justify-between bg-white/10 hover:bg-white/20 rounded-xl
                   border border-white/20 transition-all duration-300 font-semibold">
        <span>Filter Tambahan</span>
        <svg x-show="!openFilter" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" />
        </svg>
        <svg x-show="openFilter" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
        </svg>
    </button>