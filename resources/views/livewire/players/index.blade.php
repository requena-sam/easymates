<div class="container mx-auto py-8 mt-16">
    <!-- Header -->
    <div class="mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-3">Nos Joueurs</h1>
        <p class="text-gray-600 text-lg">Découvrez les talents qui représentent Gentle Mates</p>
        @role('moderator|admin')
        <div class="mt-6">
            <x-cta-modal-opener component="players.create" size="medium">{{__('Add new player')}}</x-cta-modal-opener>
        </div>
        @endrole
    </div>

    <!-- Section Live Streams -->
    @if($streamingPlayers->isNotEmpty())
        <livewire:players.streaming-section :players="$streamingPlayers"/>
    @endif

    <!-- Filtres par jeu -->
    <livewire:players.game-filters
        :games="$games"
        :selected-game="$selectedGame"
        @game-selected="selectGame($event.detail.game)"
    />

    <!-- Liste des joueurs par jeu -->
    <livewire:players.player-list :players="$players"/>
    @livewire('components.modal')
    @livewire('components.alert')
</div>
