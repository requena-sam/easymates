<div>
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
        <h3 class="text-xl sm:text-2xl font-bold">Co-hébergements disponibles</h3>
        <x-cta-modal-opener component="cohosting.create" size="medium" elementId="{{ $eventId }}" class="w-full sm:w-auto">
            Proposer un co-hébergement
        </x-cta-modal-opener>
    </div>

    @if($coHostings->isEmpty())
        <div class="text-center py-12 bg-gray-50 rounded-2xl px-4">
            <svg class="w-12 h-12 sm:w-16 sm:h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            <p class="text-gray-500 text-base sm:text-lg mb-4">Aucun co-hébergement disponible pour cet événement.</p>
            @auth
                <p class="text-gray-400 text-sm">Soyez le premier à proposer un logement !</p>
            @endauth
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
            @foreach($coHostings as $coHosting)
                <div
                    wire:click="$dispatch('openModal', { component: 'cohosting.show', size: 'large', coHostingId: {{ $coHosting->id }} })"
                    class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow cursor-pointer group"
                >
                    <!-- Image -->
                    <div class="relative">
                        @if($coHosting->getThumbnailUrl())
                            <img
                                src="{{ $coHosting->getThumbnailUrl() }}"
                                alt="{{ $coHosting->title }}"
                                class="w-full h-40 sm:h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                            >
                        @else
                            <div class="w-full h-40 sm:h-48 bg-gray-200 flex items-center justify-center">
                                <svg class="w-10 h-10 sm:w-12 sm:h-12 text-gray-400" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                            </div>
                        @endif

                        <!-- Badge places disponibles -->
                        <div class="absolute top-2 sm:top-3 left-2 sm:left-3 bg-white rounded-full px-2 sm:px-3 py-1 shadow-sm">
                            <span class="text-xs font-medium flex items-center gap-1">
                                <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 bg-green-500 rounded-full"></span>
                                {{ $coHosting->available_spots }} place{{ $coHosting->available_spots > 1 ? 's' : '' }}
                            </span>
                        </div>

                        <!-- Indicateur images multiples -->
                        @if(!empty($coHosting->image_uuids) && is_array($coHosting->image_uuids) && count($coHosting->image_uuids) > 1)
                            <div class="absolute bottom-2 sm:bottom-3 right-2 sm:right-3 bg-black/50 rounded-full px-2 py-1">
                                <span class="text-white text-xs flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ count($coHosting->image_uuids) }}
                                </span>
                            </div>
                        @endif
                    </div>

                    <!-- Contenu -->
                    <div class="py-3 px-4 sm:py-4 sm:px-5">
                        <h4 class="font-semibold text-sm sm:text-base mb-2 line-clamp-1 group-hover:text-[var(--color-primary)] transition">
                            {{ $coHosting->title }}
                        </h4>
                        <p class="text-gray-600 text-xs sm:text-sm mb-3 sm:mb-4 line-clamp-2">{{ $coHosting->description }}</p>

                        <!-- Infos en bas -->
                        <div class="flex items-center justify-between gap-2">
                            <!-- Dates -->
                            <div class="rounded-full px-2 sm:px-3 py-1 sm:py-1.5 bg-gray-100 flex-1 min-w-0">
                                <p class="text-xs text-center truncate">
                                    {{ $coHosting->start_date->format('d') }} - {{ $coHosting->end_date->format('d') }}
                                    {{ $coHosting->start_date->translatedFormat('M') }}
                                </p>
                            </div>

                            <!-- Prix -->
                            <div class="rounded-full px-2 sm:px-3 py-1 sm:py-1.5 bg-[var(--color-pink-100)] text-[var(--color-primary)] shrink-0">
                                <p class="text-xs font-semibold whitespace-nowrap">
                                    {{ number_format($coHosting->price_per_person, 2, ',', ' ') }}€
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
