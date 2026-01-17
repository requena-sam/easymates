<div>
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Ajouter un joueur favori</h2>

    <div class="max-h-96 overflow-y-auto space-y-2">
        @foreach($allPlayers as $player)
            @php
                $isFavorite = $favoritePlayers->contains('id', $player->id);
            @endphp

            <button
                wire:click="toggleFavorite({{ $player->id }})"
                class="w-full flex items-center gap-4 p-3 rounded-xl hover:bg-gray-50 transition {{ $isFavorite ? 'bg-[var(--color-pink-50)]' : '' }}">
                <div
                    class="w-12 h-12 rounded-full overflow-hidden border-2 {{ $isFavorite ? 'border-[var(--color-primary)]' : 'border-gray-200' }} relative flex-shrink-0">
                    <img src="{{ $player->getProfilePictureUrl('small') }}"
                         alt="{{ $player->pseudo }}"
                         class="w-full h-full object-cover object-top">
                    <div
                        class="absolute bottom-0 right-0 w-3 h-3 rounded-full border-2 border-white {{ $player->is_streaming ? 'bg-green-500' : 'bg-gray-400' }}"></div>
                </div>

                <div class="flex-1 text-left min-w-0">
                    <div class="font-medium text-gray-900">{{ $player->pseudo }}</div>
                    <div class="text-sm text-gray-600">{{ $player->game_name }}</div>
                </div>

                @if($isFavorite)
                    <svg class="w-5 h-5 text-[var(--color-primary)]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                              clip-rule="evenodd"/>
                    </svg>
                @endif
            </button>
        @endforeach
    </div>
</div>
