<?php

namespace App\Livewire\Players;

use Livewire\Component;

class GameFilters extends Component
{
    public array $games;
    public string $selectedGame;

    public function mount(array $games, string $selectedGame)
    {
        $this->games = $games;
        $this->selectedGame = $selectedGame;
    }

    public function selectGame($game)
    {
        $this->selectedGame = $game;
        $this->dispatch('game-selected', game: $game);
    }

    public function render()
    {
        return view('livewire.players.game-filters');
    }
}
