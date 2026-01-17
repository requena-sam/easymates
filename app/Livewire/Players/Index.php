<?php

namespace App\Livewire\Players;

use App\Models\Player;
use Livewire\Component;

class Index extends Component
{
    public $selectedGame = 'all';

    public function mount()
    {
    }

    public function selectGame($game)
    {
        $this->selectedGame = $game;
    }

    public function render()
    {
        $streamingPlayers = Player::streaming()
            ->orderBy('viewer_count', 'desc')
            ->get();

        $games = Player::select('game_name')
            ->distinct()
            ->orderBy('game_name')
            ->pluck('game_name')
            ->toArray();

        $playersQuery = Player::query();

        if ($this->selectedGame !== 'all') {
            $playersQuery->byGame($this->selectedGame);
        }

        $players = $playersQuery->orderBy('game_name')
            ->orderBy('player_number')
            ->get()
            ->groupBy('game_name')->map(fn($group) => $group->values());

        return view('livewire.players.index', [
            'streamingPlayers' => $streamingPlayers,
            'players' => $players,
            'games' => $games,
        ]);
    }
}
