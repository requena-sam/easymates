<div
    x-data
    x-init="$watch('$wire.show', value => {
        if (value) {
            document.body.classList.add('overflow-hidden');
        }
    })"
>
    @if($show)
        <div class="fixed inset-0 z-[60]" aria-modal="true" role="dialog">
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity"
                 wire:click="closeEditModal"></div>
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="relative bg-white rounded-2xl w-full max-w-2xl transform transition-all"
                     @keydown.escape.window="$wire.closeEditModal()">
                    <button
                        wire:click="closeEditModal"
                        class="absolute -top-12 right-0 z-10 p-2.5 bg-white rounded-full hover:bg-gray-100 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    <div class="px-16 py-12 max-h-[80vh] overflow-y-auto">
                        @if($component)
                            @livewire($component, $componentParams)
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
