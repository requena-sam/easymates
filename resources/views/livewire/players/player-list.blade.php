<div>
    @foreach($players as $gameName => $gamePlayers)
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ $gameName }}</h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @foreach($gamePlayers as $player)
                    <livewire:players.player-card :player="$player" :key="$player->id"/>
                @endforeach
            </div>
        </div>
    @endforeach
    @if($players->isEmpty())
        <div class="text-center py-16">
            <svg class="w-20 h-20 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            <p class="text-gray-500 text-lg">Aucun joueur trouvé pour ce jeu.</p>
        </div>
    @endif
</div>
