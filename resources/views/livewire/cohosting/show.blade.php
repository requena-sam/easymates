<div class="max-w-full px-4 sm:px-0">
    <div class="flex justify-end gap-2">
        @if($coHosting->user_id === auth()->id())
            <button
                wire:click="$dispatch('openEditModal', { component: 'cohosting.delete-confirmation', elementId: {{ $coHosting->id }} })"
                class="static sm:absolute sm:-top-12 sm:right-24 z-10 p-2 mb-4 sm:p-2.5 bg-red-500 text-white rounded-full hover:bg-red-600">
                <x-icons.delete class="w-4 h-4 sm:w-5 sm:h-5"></x-icons.delete>
            </button>
            <button
                wire:click="$dispatch('openEditModal', { component: 'cohosting.edit', coHostingId: {{ $coHosting->id }} })"
                class="static sm:absolute sm:-top-12 sm:right-12 z-10 p-2 mb-4 sm:p-2.5 bg-gray-100 hover:bg-gray-200 text-[var(--color-zinc-900)] rounded-full">
                <x-icons.edit class="w-4 h-4 sm:w-5 sm:h-5"></x-icons.edit>
            </button>
        @else
            <button
                wire:click="$dispatch('openEditModal', { component: 'cohosting.report-co-hosting', coHostingId: {{ $coHosting->id }} })"
                class="static sm:absolute sm:-top-12 sm:right-12 z-10 p-2 mb-4 sm:p-2.5 bg-red-500 text-white rounded-full hover:bg-red-600"
                title="Signaler ce co-hébergement">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </button>
        @endif
        @role('moderator|admin')
        @if($coHosting->user_id !== auth()->id())
            <button
                wire:click="$dispatch('openEditModal', { component: 'components.delete-confirmation-moderation', elementId: {{ $coHosting->id }}, itemType: 'cohosting' })"
                class="static sm:absolute sm:-top-12 sm:right-24 z-10 p-2 mb-4 sm:p-2.5 bg-orange-600 text-white rounded-full hover:bg-orange-700"
                title="Supprimer (Modération)">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </button>
        @endif
        @endrole
    </div>

    <div class="flex gap-3 sm:gap-4 items-center mb-4 sm:mb-6">
        <figure class="w-12 h-12 sm:w-16 sm:h-16 rounded-full overflow-hidden flex-shrink-0">
            <img src="{{$coHosting->user->getProfilePictureUrl('small')}}" alt=""
                 class="object-cover object-top w-full h-full"/>
        </figure>
        <div class="flex flex-col gap-1 min-w-0 flex-1">
            <h2 class="text-lg sm:text-xl font-semibold text-gray-900 break-words line-clamp-2">{{ $coHosting->title }}</h2>
            <p class="text-sm sm:text-base font-medium text-[var(--color-primary)]">{{ $coHosting->user->name }}</p>
        </div>
    </div>

    @php
        $imageUrls = $coHosting->getImageUrls('large');
        $imageCount = count($imageUrls);
    @endphp

    @if($imageCount > 0)
        <div
            x-data="{
                current: 0,
                total: {{ $imageCount }},
                next() { this.current = (this.current + 1) % this.total },
                prev() { this.current = (this.current - 1 + this.total) % this.total }
            }"
            class="relative mb-4 sm:mb-6"
        >
            <div
                class="relative w-full h-64 sm:h-96 lg:h-[500px] rounded-xl sm:rounded-2xl overflow-hidden bg-gray-100">
                @foreach($imageUrls as $index => $imageUrl)
                    <div
                        x-show="current === {{ $index }}"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="absolute inset-0 flex items-center justify-center"
                    >
                        <img
                            src="{{ $imageUrl }}"
                            alt="{{ $coHosting->title }} - Image {{ $index + 1 }}"
                            class="w-full h-full object-contain"
                            loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                        >
                    </div>
                @endforeach
            </div>

            @if($imageCount > 1)
                <button
                    @click="prev()"
                    class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white text-gray-800 rounded-full p-2 sm:p-3 shadow-lg transition z-10"
                    aria-label="Image précédente"
                >
                    <svg class="w-4 h-4 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                <button
                    @click="next()"
                    class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white text-gray-800 rounded-full p-2 sm:p-3 shadow-lg transition z-10"
                    aria-label="Image suivante"
                >
                    <svg class="w-4 h-4 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <div class="absolute bottom-3 sm:bottom-4 left-1/2 -translate-x-1/2 flex gap-1.5 sm:gap-2 z-10">
                    @foreach($imageUrls as $index => $imageUrl)
                        <button
                            @click="current = {{ $index }}"
                            class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full transition"
                            :class="current === {{ $index }} ? 'bg-white w-4 sm:w-6' : 'bg-white/50 hover:bg-white/75'"
                            aria-label="Aller à l'image {{ $index + 1 }}"
                        ></button>
                    @endforeach
                </div>

                <div
                    class="absolute top-3 sm:top-4 right-3 sm:right-4 bg-black/50 text-white px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm z-10">
                    <span x-text="current + 1"></span> / {{ $imageCount }}
                </div>
            @endif
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-[2fr_1fr] gap-6 sm:gap-8 mt-4 sm:mt-6">
        <div class="flex flex-col gap-4 sm:gap-6">
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 sm:gap-3">
                <div class="bg-[var(--color-pink-50)] rounded-lg sm:rounded-xl p-3 sm:p-4">
                    <p class="text-xs text-gray-600 mb-1">Places</p>
                    <p class="text-base sm:text-lg font-semibold text-gray-900">{{ $coHosting->available_spots }}</p>
                </div>
                <div class="bg-[var(--color-pink-50)] rounded-lg sm:rounded-xl p-3 sm:p-4">
                    <p class="text-xs text-gray-600 mb-1">Prix/personne</p>
                    <p class="text-base sm:text-lg font-semibold text-gray-900">{{ $coHosting->price_per_person }}€</p>
                </div>
                <div class="bg-[var(--color-pink-50)] rounded-lg sm:rounded-xl p-3 sm:p-4 col-span-2">
                    <p class="text-xs text-gray-600 mb-1">Dates</p>
                    <p class="text-xs sm:text-sm font-semibold text-gray-900">
                        {{ $coHosting->start_date->format('d/m') }} - {{ $coHosting->end_date->format('d/m/Y') }}
                    </p>
                </div>
            </div>

            <div class="flex flex-col gap-2 sm:gap-3">
                <h3 class="font-semibold text-lg sm:text-xl text-gray-900">Description</h3>
                <p class="text-sm sm:text-base text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $coHosting->description }}</p>
            </div>

            @if($coHosting->author_message)
                <div class="flex flex-col gap-2 sm:gap-3 bg-blue-50 rounded-lg sm:rounded-xl p-3 sm:p-4">
                    <h3 class="font-semibold text-base sm:text-lg text-gray-900 flex items-center gap-2">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                        </svg>
                        Message de l'hôte
                    </h3>
                    <p class="text-sm sm:text-base text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $coHosting->author_message }}</p>
                </div>
            @endif

            <div class="flex flex-col gap-2 sm:gap-3">
                <h3 class="font-semibold text-lg sm:text-xl text-gray-900 flex items-center gap-2">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Adresse
                </h3>
                <p class="text-sm sm:text-base text-gray-700">{{ $coHosting->address }}</p>
            </div>
        </div>

        <div class="lg:sticky lg:top-4 h-fit space-y-4 sm:space-y-6">
            @if($coHosting->listing_link)
                <a href="{{ $coHosting->listing_link }}" target="_blank"
                   class="block w-full px-4 sm:px-6 py-3 sm:py-4 bg-[var(--color-pink-700)] text-white text-center text-sm sm:text-base rounded-xl sm:rounded-2xl hover:bg-[var(--color-pink-900)] transition font-medium">
                    Voir l'annonce complète
                </a>
            @endif

            @if($coHosting->whatsapp || $coHosting->discord || $coHosting->twitter || $coHosting->instagram)
                <div class="bg-gray-50 rounded-xl sm:rounded-2xl p-4 sm:p-6 space-y-3 sm:space-y-4">
                    <h3 class="font-semibold text-base sm:text-lg text-gray-900">Contact</h3>
                    @if($coHosting->whatsapp)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $coHosting->whatsapp) }}"
                           target="_blank"
                           class="flex items-center gap-2 sm:gap-3 text-gray-700 hover:text-[var(--color-primary)] transition">
                            <x-whatsapp class="w-5 h-5 sm:w-6 sm:h-6"></x-whatsapp>
                            <span class="text-xs sm:text-sm">{{ $coHosting->whatsapp }}</span>
                        </a>
                    @endif
                    @if($coHosting->discord)
                        <div class="flex items-center gap-2 sm:gap-3 text-gray-700">
                            <x-discord class="w-5 h-5 sm:w-6 sm:h-6"></x-discord>
                            <span class="text-xs sm:text-sm break-all">{{ $coHosting->discord }}</span>
                        </div>
                    @endif
                    @if($coHosting->twitter)
                        <a href="https://twitter.com/{{ ltrim($coHosting->twitter, '@') }}" target="_blank"
                           class="flex items-center gap-2 sm:gap-3 text-gray-700 hover:text-[var(--color-primary)] transition">
                            <x-twitter class="w-5 h-5 sm:w-6 sm:h-6"></x-twitter>
                            <span class="text-xs sm:text-sm">{{ $coHosting->twitter }}</span>
                        </a>
                    @endif
                    @if($coHosting->instagram)
                        <a href="https://instagram.com/{{ ltrim($coHosting->instagram, '@') }}" target="_blank"
                           class="flex items-center gap-2 sm:gap-3 text-gray-700 hover:text-[var(--color-primary)] transition">
                            <x-instagram class="w-5 h-5 sm:w-6 sm:h-6"></x-instagram>
                            <span class="text-xs sm:text-sm">{{ $coHosting->instagram }}</span>
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
    @livewire('components.edit-modal')
</div>
