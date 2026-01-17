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
        <!-- Version Desktop -->
        <div class="hidden sm:block fixed inset-0 z-50" aria-modal="true" role="dialog">
            <div class="fixed inset-0 bg-black/30 backdrop-blur-xs transition-opacity"
                 wire:click="closeModal"></div>
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="relative bg-white rounded-2xl w-full {{ $maxWidth }} transform transition-all"
                     @keydown.escape.window="$wire.closeModal()">
                    <x-close-modal-btn></x-close-modal-btn>
                    <div
                        class="{{ $size === 'large' ? 'px-8 md:px-16 lg:px-38 py-8 md:py-12' : 'px-8 md:px-16 py-8 md:py-12' }} max-h-[80vh] overflow-y-auto">
                        @if($component)
                            @livewire($component, $componentParams)
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Version Mobile (plein écran) -->
        <div class="sm:hidden fixed inset-0 z-50" aria-modal="true" role="dialog">
            <div class="fixed inset-0 bg-white">
                <!-- Header mobile avec bouton fermer -->
                <div
                    class="sticky top-0 z-10 bg-white border-b border-gray-200 px-4 py-3 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ $size === 'large' ? 'Détails' : 'Formulaire' }}
                    </h3>
                    <button
                        wire:click="closeModal"
                        class="p-2 hover:bg-gray-100 rounded-full transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Contenu scrollable -->
                <div class="overflow-y-auto h-[calc(100vh-60px)] px-4 py-6"
                     @keydown.escape.window="$wire.closeModal()">
                    @if($component)
                        @livewire($component, $componentParams)
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
