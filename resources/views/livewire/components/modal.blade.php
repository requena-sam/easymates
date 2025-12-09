@props(['size' => 'medium'])

@php
    $sizeClasses = [
        'medium' => 'max-w-2xl',
        'large' => 'max-w-7xl',
    ];
    $maxWidth = $sizeClasses[$size] ?? $sizeClasses['medium'];
@endphp

<div
    x-data
    x-init="$watch('$wire.show', value => {
        document.body.classList.toggle('overflow-hidden', value);
    })"
>
    @if($show)
        <div class="fixed inset-0 z-50" aria-modal="true" role="dialog">
            <div class="fixed inset-0 bg-black/30 backdrop-blur-xs transition-opacity"
                 wire:click="closeModal"></div>
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="relative bg-white rounded-2xl w-full {{ $maxWidth }} transform transition-all"
                     @keydown.escape.window="$wire.closeModal()">
                    <x-close-modal-btn></x-close-modal-btn>
                    <div class="{{ $size === 'large' ? 'px-38 py-12' : 'px-16 py-12 ' }}  max-h-[80vh]  overflow-y-auto">
                        @if($component)
                            @livewire($component, $componentParams)
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
