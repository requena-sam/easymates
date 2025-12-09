@props([
    'component' => null,
    'size' => 'medium',
])

<button wire:click="$dispatch('openModal', { component: '{{$component}}', size: '{{$size}}'})"
        class="px-6 py-4 bg-[var(--color-pink-200)] rounded-2xl hover:bg-[var(--color-pink-300)] transition ease-in-out duration-300 font-medium">
    {{$slot}}
</button>
