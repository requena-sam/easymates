<div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 relative">
    @role('moderator|admin')
    <div x-data="{ menuOpen: false }" @click.away="menuOpen = false" class="absolute top-5 right-4 z-10">
        <button @click="menuOpen = !menuOpen"
                class="p-1.5 hover:bg-gray-100 rounded-lg transition-colors bg-white/80 backdrop-blur-sm">
            <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
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
                wire:click="$dispatch('openModal', { component: 'players.edit', playerId: {{ $player->id }} })"
                @click="menuOpen = false"
                class="w-full px-4 py-2.5 text-left text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-3 transition-colors">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Modifier
            </button>

            <button
                wire:click="$dispatch('openModal', { component: 'players.delete-confirmation', playerId: {{ $player->id }} })"
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
    @endrole

    <div class="flex flex-col xl:flex-row h-auto xl:h-52">
        <div class="relative w-full xl:w-52 flex-shrink-0 bg-gradient-to-br {{ $player->getGameColor() }}">
            @if($player->player_number)
                <div class="absolute inset-0 flex items-center justify-center opacity-20">
                    <span class="text-white text-[100px] xl:text-[120px] font-black leading-none">
                        {{ $player->player_number }}
                    </span>
                </div>
            @endif

            @if($player->player_number)
                <div
                    class="absolute top-3 left-3 xl:top-4 xl:left-4 bg-white/20 backdrop-blur-sm text-white px-3 py-1 rounded-lg text-sm font-bold">
                    #{{ $player->player_number }}
                </div>
            @endif

            <div class="flex items-center justify-center p-6">
                <div class="relative">
                    <img
                        src="{{ $player->getProfilePictureUrl('medium') }}"
                        alt="{{ $player->pseudo }}"
                        class="z-10 w-28 h-28 sm:w-32 sm:h-32 xl:w-36 xl:h-36 rounded-full border-4 border-white object-cover object-top shadow-2xl group-hover:scale-105 transition-transform duration-300">
                    @if($player->is_streaming)
                        <div
                            class="absolute -bottom-1 -right-1 w-8 h-8 bg-red-500 rounded-full border-4 border-white flex items-center justify-center">
                            <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="flex-1 p-6 flex flex-col justify-between">
            <div>
                <div class="flex flex-col sm:flex-row sm:justify-between gap-2 mb-3">
                    <div>
                        <h3 class="text-xl xl:text-2xl font-bold text-gray-900">
                            {{ $player->pseudo }}
                        </h3>
                        <p class="text-sm text-gray-600">
                            {{ $player->full_name }}
                        </p>
                    </div>

                    @if($player->role)
                        <span
                            class="px-3 mr-7 py-1 bg-[var(--color-pink-200)] text-[var(--color-primary)] rounded-full text-xs font-medium self-start">
                            {{ $player->role }}
                        </span>
                    @endif
                </div>

                @if($player->description)
                    <p class="text-sm text-gray-600 line-clamp-2 break-words">
                        {{ $player->description }}
                    </p>
                @endif
            </div>

            <div class="flex flex-wrap gap-2 pt-4 border-t border-gray-100">
                @if($player->twitch)
                    <x-twitch isCta="true" link="{{$player->twitch}}"/>
                @endif
                @if($player->youtube)
                    <x-youtube isCta="true" link="{{$player->youtube}}"/>
                @endif
                @if($player->twitter)
                    <x-twitter isCta="true" link="{{$player->twitter}}"/>
                @endif
                @if($player->instagram)
                    <x-instagram isCta="true" link="{{$player->instagram}}"/>
                @endif
            </div>
        </div>
    </div>
</div>
