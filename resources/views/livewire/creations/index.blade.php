<div class="w-full">
    <!-- Header -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col items-center my-16 gap-4 text-center">
            <x-heading-content title="{{ __('Community Creations') }}">
                {{ __("Discover the creativity of fans through their posts and projects related to Gentle Mates!
                Feel free to share your fan art, wallpapers, or even photos.") }}
            </x-heading-content>

            <x-cta-modal-opener component="creations.create" size="medium">
                {{ __('Post new creation') }}
            </x-cta-modal-opener>
        </div>
    </div>

    <!-- Content -->
    <div class="container mx-auto">
        @livewire('creations.creations-filters')
        @livewire('creations.creations-list')
    </div>

    @livewire('components.modal')
    @livewire('components.alert')
</div>
