<nav x-data="{ open: false }"
     @keydown.escape.window="open = false"
     class="relative">
    <h2 class="sr-only">{{__('Main Navigation')}}</h2>
    <div class="flex items-center justify-between">
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
    </div>
</nav>
