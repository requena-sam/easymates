<div class="mb-6 sm:mb-8 mx-auto  ">
    <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4 lg:gap-6">
        <h2 class="text-xl sm:text-2xl font-bold">{{ __('Explore creations') }}</h2>

        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4 w-full sm:w-auto">
            <!-- Barre de recherche -->
            <div class="relative flex items-center w-full sm:w-auto">
                <input
                    type="text"
                    wire:model.live.debounce.100ms="search"
                    placeholder="{{ __('Search something...') }}"
                    class="pl-4 pr-10 py-2.5 bg-white rounded-full focus:ring-1 focus:ring-[var(--color-primary)] focus:outline-none transition-all text-sm w-full lg:w-96">
                <div class="absolute right-4 text-gray-700">
                    <x-icons.search></x-icons.search>
                </div>
            </div>

            <div class="flex flex-row gap-3 lg:gap-4">
                <!-- Tri -->
                <div class="relative flex-1 sm:flex-initial" x-data="{ open: @entangle('showSortDropdown') }">
                    <button
                        @click="open = !open"
                        class="flex items-center justify-center gap-2 px-3 sm:px-4 py-2.5 rounded-full bg-white transition-colors text-sm w-full sm:w-auto">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path>
                        </svg>
                        <span class="text-gray-700 hidden sm:inline">{{ __('Trier par') }}</span>
                    </button>

                    <div
                        x-show="open"
                        @click.outside="open = false"
                        x-transition
                        class="absolute right-0 mt-2 w-48 bg-white rounded-lg z-50 shadow-lg"
                    >
                        <div>
                            <button
                                wire:click="setSortBy('latest')"
                                class="w-full text-left px-4 py-2 text-sm rounded-t-lg hover:bg-gray-50 transition-colors {{ $sortBy === 'latest' ? 'text-[var(--color-primary)] font-medium' : 'text-gray-700' }}">
                                {{ __('Latest') }}
                            </button>
                            <button
                                wire:click="setSortBy('most_liked')"
                                class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50 transition-colors {{ $sortBy === 'most_liked' ? 'text-[var(--color-primary)] font-medium' : 'text-gray-700' }}">
                                {{ __('Most Liked') }}
                            </button>
                            <button
                                wire:click="setSortBy('oldest')"
                                class="w-full text-left px-4 py-2 text-sm rounded-b-lg hover:bg-gray-50 transition-colors {{ $sortBy === 'oldest' ? 'text-[var(--color-primary)] font-medium' : 'text-gray-700' }}">
                                {{ __('Oldest') }}
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Filtres -->
                <div class="relative flex-1 sm:flex-initial" x-data="{ open: @entangle('showTagsDropdown') }">
                    <button
                        @click="open = !open"
                        class="flex items-center justify-center gap-2 px-3 sm:px-4 py-2.5 rounded-full bg-white transition-colors text-sm w-full sm:w-auto"
                    >
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                        </svg>
                        <span class="text-gray-700 hidden sm:inline">{{ __('Filtre') }}</span>
                        @if(count($selectedTags) > 0)
                            <span
                                class="bg-[var(--color-primary)] text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                {{ count($selectedTags) }}
                            </span>
                        @endif
                    </button>

                    <div
                        x-show="open"
                        @click.outside="open = false"
                        x-transition
                        class="absolute right-0 mt-2 w-72 bg-white rounded-lg z-50 max-h-96 overflow-y-auto shadow-lg"
                    >
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="font-semibold text-gray-800 text-sm sm:text-base">{{ __('Filtrer par tags') }}</h3>
                                @if(count($selectedTags) > 0)
                                    <button
                                        wire:click="clearFilters"
                                        class="text-xs sm:text-sm text-[var(--color-primary)] hover:text-pink-700 font-medium"
                                    >
                                        {{ __('Effacer tout') }}
                                    </button>
                                @endif
                            </div>

                            <div class="space-y-1">
                                @foreach($availableTags as $tag)
                                    <label
                                        class="flex items-center gap-3 cursor-pointer hover:bg-gray-50 p-2.5 rounded-lg transition-colors">
                                        <input
                                            type="checkbox"
                                            wire:click="toggleTag('{{ $tag->value }}')"
                                            @checked(in_array($tag->value, $selectedTags))
                                            class="rounded text-[var(--color-primary)] focus:ring-[var(--color-primary)]"
                                        >
                                        <span
                                            class="text-sm text-gray-700">{{ ucwords(str_replace(['-', '_'], ' ', $tag->value)) }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
