@props([
    'text' => null,
    'icon' => null,
    'url' => '#',
    'links' => null,
    'adminLinks' => null,
])

@php
    $isActive = request()->url() === $url;
    $isIconText = $icon !== null && $text !== null;
    $hasDropdown = is_array($links) && count($links) > 0;
@endphp

<div x-data="{ dropdownOpen: false }"
     @click.away="dropdownOpen = false"
     class="relative h-11">

    <div @if($hasDropdown) @click="dropdownOpen = !dropdownOpen" @endif
    class="flex items-center bg-white rounded-full gap-2 h-full hover:bg-gray-100 transition-colors duration-150 {{ $isIconText ? 'px-5' : 'px-2.5' }} {{ $hasDropdown ? 'cursor-pointer' : '' }}">
        @if($icon !== null)
            <x-dynamic-component :component="'icons.'.$icon"/>
        @endif
        @if($text !== null)
            @if($hasDropdown)
                <span>{{ $text }}</span>
            @else
                <a href="{{ $url }}">
                    {{ $text }}
                </a>
            @endif
        @endif
    </div>

    @if($hasDropdown)
        <div x-show="dropdownOpen"
             x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="fixed left-1/2 -translate-x-1/2 top-24 w-[95vw] bg-white rounded-2xl shadow-xl z-50 sm:absolute sm:top-auto sm:left-auto sm:translate-x-0 sm:right-0 sm:mt-3 sm:w-56">
            @foreach($links as $link)
                @php
                    $isDanger = isset($link['danger']) && $link['danger'];
                    $linkClasses = 'block px-4 py-3 text-sm transition-colors duration-150 ' .
                                   ($isDanger ? 'text-red-600 hover:bg-red-50':'text-gray-700 hover:bg-gray-100');
                @endphp
                <a href="{{ $link['href'] ?? '#' }}" class="{{ $linkClasses }}">
                    {{ $link['text'] ?? '' }}
                </a>
            @endforeach
            @if($adminLinks)
                @hasanyrole('admin|moderator')
                @foreach($adminLinks as $aLink)
                    @php

                        $linkClasses = 'block px-4 py-3 text-sm text-orange-600 transition-colors duration-150 hover:bg-orange-50';

                    @endphp
                    <a href="{{ $aLink['href'] ?? '#' }}" class="{{ $linkClasses }}">
                        {{ $aLink['text'] ?? '' }}
                    </a>
                @endforeach
                @endrole
            @endif
            {{$slot}}
        </div>
    @endif
</div>
