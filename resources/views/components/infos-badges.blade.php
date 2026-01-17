@props([
    'svg' => null,
    'color' => null
])

<span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-medium
    {{ $color === 'pink'
        ? 'bg-pink-100 text-sm text-[var(--color-primary)]'
        : 'bg-gray-100 text-gray-900'
    }}">
    @if($svg)
        <x-dynamic-component :component="'icons.'.$svg"/>
    @endif
    {{ $slot }}
</span>

