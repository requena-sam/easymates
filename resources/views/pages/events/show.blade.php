<x-main-layout>
    @role('moderator|admin')
    @livewire('events.actions-btn', ['elementId' => $event->id])
    @endrole

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8 mt-8 items-start lg:items-center">
        <!-- COLONNE GAUCHE -->
        <div class="flex flex-col gap-4 lg:gap-6 order-2 lg:order-1">
            <div class="flex flex-wrap gap-2 lg:gap-3">
                <div
                    class="w-fit px-3 py-1.5 lg:px-4 lg:py-2 rounded-full text-xs font-medium bg-pink-200 text-[var(--color-primary)]">
                    <div class="flex items-center gap-2">
                        <svg class="w-3 h-3 lg:w-4 lg:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-xs lg:text-sm">
                            {{ $event->start_date->format('d') }} - {{ $event->end_date->format('d') }}
                            {{ $event->start_date->translatedFormat('F Y') }}
                        </span>
                    </div>
                </div>
                <div
                    class="w-fit px-3 py-1.5 lg:px-4 lg:py-2 rounded-full text-xs lg:text-sm font-medium bg-pink-200 text-[var(--color-primary)]">
                    {{ $event->address }}
                </div>
            </div>

            <div>
                <h2 class="text-2xl lg:text-h1 font-bold mb-3 lg:mb-4">{{ $event->name }}</h2>
                <p class="text-sm lg:text-base text-gray-700">{{ $event->description }}</p>

                <div class="flex flex-col sm:flex-row gap-3 lg:gap-4 mt-4 lg:mt-6">
                    <x-primary-btn href="{{ $event->official_ticketing_link }}" class="w-full sm:w-auto justify-center">
                        Billetterie officielle
                    </x-primary-btn>
                    <x-secondary-btn href="{{ $event->secondary_ticketing_link }}"
                                     class="w-full sm:w-auto justify-center">
                        Billetterie TGS
                    </x-secondary-btn>
                </div>
            </div>
        </div>

        <!-- COLONNE DROITE - Image -->
        <figure class="order-1 lg:order-2">
            <img
                src="{{ $event->getImageUrl('large') }}"
                alt="{{ $event->name }}"
                class="w-full h-48 sm:h-64 lg:h-auto rounded-xl object-cover">
        </figure>
    </div>

    {{-- Section avec onglets --}}
    <div class="mt-8 lg:mt-12" x-data="{ currentTab: 'cohosting' }">
        {{-- Navigation par onglets --}}
        <div class="flex flex-col sm:flex-row gap-2 sm:gap-4 mb-6 overflow-x-auto">
            <button
                @click="currentTab = 'cohosting'"
                :class="currentTab === 'cohosting' ? 'border-[var(--color-primary)] text-[var(--color-primary)] bg-pink-50 sm:bg-transparent' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                class="text-sm px-4 sm:px-6 py-2.5 sm:py-3 font-medium border-b-2 transition-colors whitespace-nowrap rounded-t-lg sm:rounded-none"
            >
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Trouver un logement</span>
                </div>
            </button>

            <button
                @click="currentTab = 'carpool'"
                :class="currentTab === 'carpool' ? 'border-[var(--color-primary)] text-[var(--color-primary)] bg-pink-50 sm:bg-transparent' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                class="text-sm px-4 sm:px-6 py-2.5 sm:py-3 font-medium border-b-2 transition-colors whitespace-nowrap rounded-t-lg sm:rounded-none"
            >
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                    </svg>
                    <span>Trouver un covoiturage</span>
                </div>
            </button>
        </div>

        {{-- Contenu des onglets --}}
        <div>
            {{-- Onglet Co-hébergements --}}
            <div x-show="currentTab === 'cohosting'" x-transition>
                @livewire('cohosting.co-hostings-list', ['eventId' => $event->id])
            </div>

            {{-- Onglet Covoiturages --}}
            <div x-show="currentTab === 'carpool'" x-transition>
                @livewire('carpool.carpools-list', ['eventId' => $event->id])
            </div>
        </div>
    </div>

    {{-- Modal et Alert --}}
    @livewire('components.modal')
    @livewire('components.alert')
</x-main-layout>
