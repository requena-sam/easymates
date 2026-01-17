<div>
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
        <h3 class="text-xl sm:text-2xl font-bold">Covoiturages disponibles</h3>
        <x-cta-modal-opener component="carpool.create" size="medium" elementId="{{ $eventId }}"
                            class="w-full sm:w-auto">
            Proposer un covoiturage
        </x-cta-modal-opener>
    </div>

    @if($carpools->isEmpty())
        <div class="text-center py-12 bg-gray-50 rounded-2xl px-4">
            <svg class="w-12 h-12 sm:w-16 sm:h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
            </svg>
            <p class="text-gray-500 text-base sm:text-lg mb-4">Aucun covoiturage disponible pour cet événement.</p>
            @auth
                <p class="text-gray-400 text-sm">Soyez le premier à proposer un trajet !</p>
            @endauth
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
            @foreach($carpools as $carpool)
                <div
                    class="group bg-white rounded-2xl p-4 sm:p-5 border border-gray-100 shadow-sm hover:shadow-md hover:border-gray-200 transition relative">

                    {{-- Menu d'actions (uniquement pour le propriétaire) --}}
                    @if(auth()->check() && $carpool->user_id === auth()->id())
                        <div x-data="{ menuOpen: false }" @click.away="menuOpen = false"
                             class="absolute top-4 right-4 z-10">
                            <button @click="menuOpen = !menuOpen"
                                    class="p-1.5 hover:bg-gray-100 rounded-lg transition-colors">
                                <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                </svg>
                            </button>

                            <div x-show="menuOpen"
                                 x-cloak
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-200 py-1">

                                <button
                                    wire:click="$dispatch('openModal', { component: 'carpool.edit', carpoolId: {{ $carpool->id }} })"
                                    @click="menuOpen = false"
                                    class="w-full px-4 py-2.5 text-left text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-3 transition-colors">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Modifier
                                </button>

                                <button
                                    wire:click="$dispatch('openModal', { component: 'carpool.delete-confirmation', carpoolId: {{ $carpool->id }} })"
                                    @click="menuOpen = false"
                                    class="w-full px-4 py-2.5 text-left text-sm text-red-600 hover:bg-red-50 flex items-center gap-3 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Supprimer
                                </button>
                            </div>
                        </div>
                    @endif

                    <!-- Header -->
                    <div class="flex items-start sm:items-center justify-between gap-2 sm:gap-3 mb-4">
                        <div class="flex items-center gap-2 sm:gap-3 min-w-0 flex-1">
                            <div
                                class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-gray-200 overflow-hidden shrink-0 ring-2 ring-white">
                                <img src="{{ $carpool->user->getProfilePictureUrl('small') }}" alt=""
                                     class="object-cover object-top w-full h-full"/>
                            </div>

                            <div class="min-w-0 flex-1">
                                <p class="font-semibold text-sm sm:text-base text-gray-900 truncate">
                                    {{ $carpool->user->name }}
                                </p>
                                <p class="text-xs text-gray-500 truncate">
                                    Trajet proposé
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Trip -->
                    <div class="rounded-xl mb-4">
                        <div class="flex gap-2 sm:gap-3">
                            <!-- timeline -->
                            <div class="flex flex-col items-center pt-1">
                                <span
                                    class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-white border-2 border-[var(--color-primary)]"></span>
                                <span class="w-px flex-1 bg-gray-300 my-1"></span>
                                <span class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-[var(--color-primary)]"></span>
                            </div>

                            <div class="min-w-0 flex-1 space-y-2 sm:space-y-3">
                                <div class="min-w-0">
                                    <p class="text-[10px] sm:text-[11px] uppercase tracking-wide text-gray-500">
                                        Départ</p>
                                    <p class="text-xs sm:text-sm font-medium text-gray-900 line-clamp-2">
                                        {{ $carpool->departure_address }}
                                    </p>
                                </div>

                                <div class="min-w-0">
                                    <p class="text-[10px] sm:text-[11px] uppercase tracking-wide text-gray-500">
                                        Arrivée</p>
                                    <p class="text-xs sm:text-sm font-medium text-gray-900 line-clamp-2">
                                        {{ $carpool->arrival_address }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-1.5 sm:gap-2 mb-4">
                        <x-infos-badges svg="calendar">
                            <span
                                class="text-xs">{{ $carpool->start_date->format('d') }}–{{ $carpool->end_date->format('d') }} {{ $carpool->start_date->translatedFormat('M') }}</span>
                        </x-infos-badges>
                        <x-infos-badges svg="money-round">
                            <span class="text-xs">~ {{ number_format($carpool->price_per_person, 0, ',', ' ') }}€</span>
                        </x-infos-badges>
                        <x-infos-badges svg="group-persons" color="pink">
                            <span
                                class="text-xs">{{ $carpool->available_spots }} siège{{ $carpool->available_spots > 1 ? 's' : '' }}</span>
                        </x-infos-badges>
                    </div>

                    <!-- Footer: contacts -->
                    @if($carpool->whatsapp || $carpool->discord || $carpool->twitter || $carpool->instagram)
                        <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                            <span class="text-xs text-gray-500">Contacter</span>
                            <div class="flex items-center gap-1.5 sm:gap-2">
                                @if($carpool->whatsapp)
                                    <x-whatsapp isCta="true" link="{{$carpool->whatsapp}}"></x-whatsapp>
                                @endif

                                @if($carpool->discord)
                                    <x-discord isCta="true" link="{{$carpool->discord}}"></x-discord>
                                @endif

                                @if($carpool->twitter)
                                    <x-twitter isCta="true" link="{{$carpool->twitter}}"></x-twitter>
                                @endif

                                @if($carpool->instagram)
                                    <x-instagram isCta="true" link="{{$carpool->instagram}}"></x-instagram>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
