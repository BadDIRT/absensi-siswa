<!-- SORTING -->
    <div class="flex flex-col gap-1">
        <label class="text-sm text-white/70">Urutkan Berdasarkan</label>
        <select name="sort_order"
                class="px-4 py-3 rounded-xl bg-white/20 backdrop-blur-xl text-white border border-white/30
                       focus:ring-2 focus:ring-white/40 transition">
            <option value="" class="text-black" >— Default —</option>
            <option value="latest" class="text-black"  request('sort_order') == 'latest' ? 'selected' : '' }}>
                Terbaru → Terlama
            </option>
            <option value="oldest" class="text-black" {{ request('sort_order') == 'oldest' ? 'selected' : '' }}>
                Terlama → Terbaru
            </option>
        </select>
    </div>