<div>
    <div class="flex flex-col items-center my-16 gap-4">
        <x-heading-content title="{{__('Community Creations')}}">
            {{__("Discover the creativity of fans through their posts and projects related to Gentle Mates!
    Feel free to share your fan art, wallpapers, or even photos.")}}
        </x-heading-content>
        <x-cta-modal-opener component="creations.create" size="medium">Post new creation</x-cta-modal-opener>
    </div>

    @livewire('creations.creations-filters')
    @livewire('creations.creations-list')
    @livewire('components.modal')
    @livewire('components.alert')
</div>
