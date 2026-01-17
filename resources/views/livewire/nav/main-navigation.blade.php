<div x-data="{ open: false }"
     @keydown.escape.window="open = false"
     class="relative">

    <!-- Bouton hamburger pour mobile -->
    <button @click="open = !open"
            class="md:hidden flex items-center justify-center w-11 h-11 bg-white rounded-full hover:bg-gray-100 transition-colors duration-150"
            aria-label="Menu">
        <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
        <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>

    <!-- Navigation desktop (cachée sur mobile) -->
    <ul class="hidden md:flex gap-2 bg-white rounded-full h-11 w-fit items-center">
        @foreach($links as $link)
            @php
                $isActive = request()->routeIs($link['route']);
                $base = 'h-full inline-flex items-center px-5 rounded-full transition-colors duration-150';
                $active = 'bg-black text-white';
                $inactive = 'bg-transparent hover:bg-gray-100';
                $classes = $base . ' ' . ($isActive ? $active : $inactive);
            @endphp
            <li class="h-full">
                <a href="{{ route($link['route']) }}" class="{{ $classes }}">
                    <span>{{ $link['text'] }}</span>
                </a>
            </li>
        @endforeach
    </ul>

    <!-- Menu mobile dropdown -->
    <div x-show="open"
         @click.away="open = false"
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="fixed left-1/2 -translate-x-1/2 top-24 w-[95vw] bg-white rounded-2xl shadow-xl z-50 md:absolute md:top-full md:mt-3 md:left-auto md:translate-x-0 md:right-0 md:w-56">
        <ul>
            @foreach($links as $link)
                @php
                    $isActive = request()->routeIs($link['route']);

                    $rounded = '';
                    if ($loop->first) {
                        $rounded = 'rounded-t-2xl';
                    } elseif ($loop->last) {
                        $rounded = 'rounded-b-2xl';
                    }

                    $linkClasses = 'block px-4 py-3 text-sm transition-colors duration-150 ' . $rounded . ' ' .
                                   ($isActive ? 'bg-black text-white' : 'text-gray-700 hover:bg-gray-100');
                @endphp

                <li>
                    <a href="{{ route($link['route']) }}"
                       class="{{ $linkClasses }}"
                       @click="open = false">
                        {{ $link['text'] }}
                    </a>
                </li>
            @endforeach
        </ul>

    </div>
</div>
