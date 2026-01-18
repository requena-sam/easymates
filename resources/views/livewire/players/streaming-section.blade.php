<div class="mb-12 md:mb-16">
    <div class="flex items-center gap-2 md:gap-3 mb-4 md:mb-6" wire:poll.30s="loadPlayers">
        <div class="relative flex items-center">
            <div class="w-2.5 h-2.5 md:w-3 md:h-3 bg-red-500 rounded-full animate-pulse"></div>
            <div class="absolute w-2.5 h-2.5 md:w-3 md:h-3 bg-red-500 rounded-full animate-ping"></div>
        </div>
        <h2 class="text-xl md:text-2xl font-bold text-gray-900">En Direct Maintenant</h2>
        <span class="px-2 py-0.5 md:px-3 md:py-1 bg-red-100 text-red-700 rounded-full text-xs md:text-sm font-medium">
            {{ $players->count() }}
        </span>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-2 md:gap-3">
        @foreach($players as $player)
            <a href="https://twitch.tv/{{ $player->twitch }}" target="_blank"
               class="block group relative">
                <div
                    class="relative bg-white rounded-lg md:rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-200 hover:border-red-500">

                    <div class="relative aspect-square bg-gradient-to-br {{ $player->getGameColor() }}">
                        <img src="{{ $player->getProfilePictureUrl('small') }}"
                             alt="{{ $player->pseudo }}"
                             class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-300">

                        <div
                            class="absolute top-1.5 left-1.5 md:top-2 md:left-2 flex items-center gap-1 md:gap-1.5 bg-red-500 text-white px-1.5 py-0.5 md:px-2 rounded-md text-[10px] md:text-xs font-bold">
                            <div class="w-1 h-1 md:w-1.5 md:h-1.5 bg-white rounded-full"></div>
                            LIVE
                        </div>

                        <div
                            class="absolute bottom-1.5 right-1.5 md:bottom-2 md:right-2 bg-black/70 text-white px-1.5 py-0.5 md:px-2 rounded text-[10px] md:text-xs font-medium flex items-center gap-0.5 md:gap-1">
                            <svg class="w-2.5 h-2.5 md:w-3 md:h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                <path fill-rule="evenodd"
                                      d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="hidden sm:inline">{{ number_format($player->viewer_count) }}</span>
                            <span
                                class="sm:hidden">{{ $player->viewer_count > 1000 ? number_format($player->viewer_count / 1000, 1) . 'k' : $player->viewer_count }}</span>
                        </div>
                    </div>
                    <div class="p-2 md:p-3">
                        <h3 class="font-bold text-xs md:text-sm text-gray-900 truncate group-hover:text-[var(--color-primary)] transition">
                            {{ $player->pseudo }}
                        </h3>
                        <p class="text-[10px] md:text-xs text-gray-500 truncate">{{ $player->game_name }}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
