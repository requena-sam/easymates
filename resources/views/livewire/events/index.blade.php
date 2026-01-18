<div class="container mx-auto">
    <div class="flex flex-col items-center my-16 gap-4">
        <x-heading-content title="{{__('Events Gentle Mates')}}">
            {{__("Find all events such as Majors, league matches, world championships, or even simple LAN parties for your favorite game. For these events, you can also find solutions to your needs, such as on-site accommodation or carpooling options.")}}
        </x-heading-content>
        @role('admin|moderator')
        <x-cta-modal-opener component="events.create" size="medium">{{__('Post new event')}}</x-cta-modal-opener>
        @endrole
    </div>
    @livewire('events.events-list')
    @livewire('components.modal')
    @livewire('components.alert')
</div>
