@if ($paginator->hasPages())
    <nav role="navigation" class="flex justify-center mt-6">
        <ul class="inline-flex items-center gap-2">

            {{-- Previous Page --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-2 bg-white/10 backdrop-blur-xl border border-white/20 text-white/40 rounded-xl cursor-not-allowed">
                    ‹
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" 
                   class="px-3 py-2 bg-white/10 hover:bg-white/20 backdrop-blur-xl border border-white/20 text-white rounded-xl transition-all duration-300 hover:scale-105">
                    ‹
                </a>
            @endif

            {{-- Numbered Pages --}}
            @foreach ($elements as $element)

                {{-- Dots --}}
                @if (is_string($element))
                    <span class="px-3 py-2 text-white/40">{{ $element }}</span>
                @endif

                {{-- Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)

                        @if ($page == $paginator->currentPage())
                            <span class="px-4 py-2 bg-white/20 backdrop-blur-2xl border border-white/30 text-white font-semibold rounded-xl shadow-md">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                               class="px-4 py-2 bg-white/10 hover:bg-white/20 backdrop-blur-xl border border-white/20 text-white rounded-xl transition-all duration-300 hover:scale-105">
                                {{ $page }}
                            </a>
                        @endif

                    @endforeach
                @endif

            @endforeach

            {{-- Next Page --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" 
                   class="px-3 py-2 bg-white/10 hover:bg-white/20 backdrop-blur-xl border border-white/20 text-white rounded-xl transition-all duration-300 hover:scale-105">
                    ›
                </a>
            @else
                <span class="px-3 py-2 bg-white/10 backdrop-blur-xl border border-white/20 text-white/40 rounded-xl cursor-not-allowed">
                    ›
                </span>
            @endif

        </ul>
    </nav>
@endif
