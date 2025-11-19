<!-- Filter Value -->
    <div class="flex flex-col gap-1">
        <label class="text-sm text-white/70">Nilai Filter</label>
        <input type="text" name="filter_value" value="{{ request('filter_value') }}"
               placeholder="Masukkan nilai filter..."
               class="px-4 py-3 rounded-xl bg-white/20 text-white border border-white/30
                      focus:ring-2 focus:ring-white/40 transition">
    </div>