<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 mt-12 sm:mt-16">
    <div class="mb-8 sm:mb-12">
        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-2 sm:mb-3">Nos Joueurs</h1>
        <p class="text-gray-600 text-base sm:text-lg">Découvrez les talents qui représentent Gentle Mates</p>
        @role('moderator|admin')
        <div class="mt-4 sm:mt-6">
            <x-cta-modal-opener component="players.create" size="medium">{{__('Add new player')}}</x-cta-modal-opener>
        </div>
        @endrole
    </div>

    @if($streamingPlayers->isNotEmpty())
        <livewire:players.streaming-section :players="$streamingPlayers"/>
    @endif

    <livewire:players.game-filters
        :games="$games"
        :selected-game="$selectedGame"
    />

    <div>
        @foreach($players as $gameName => $gamePlayers)
            <div class="mb-12 sm:mb-16" wire:key="game-section-{{ $gameName }}">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4 sm:mb-6">{{ $gameName }}</h2>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                    @foreach($gamePlayers as $player)
                        <livewire:players.player-card :player="$player" :key="'player-'.$player->id"/>
                    @endforeach
                </div>
            </div>
        @endforeach

        @if($players->isEmpty())
            <div class="text-center py-12 sm:py-16">
                <svg class="w-16 h-16 sm:w-20 sm:h-20 mx-auto text-gray-400 mb-3 sm:mb-4" fill="none"
                     stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <p class="text-gray-500 text-base sm:text-lg">Aucun joueur trouvé pour ce jeu.</p>
            </div>
        @endif
    </div>

    @livewire('components.modal')
    @livewire('components.alert')
</div>
