<?php

namespace App\Livewire\Dashboard;

use App\Models\Player;
use Livewire\Component;

class AddFavoritePlayer extends Component
{
    protected $listeners = ['favoriteToggled' => '$refresh'];

    public function render()
    {
        $allPlayers = Player::orderBy('pseudo')->get();

        $favoritePlayers = auth()->user()->favoritePlayers()
            ->orderBy('favorite_players.created_at', 'desc')
            ->get();

        return view('livewire.dashboard.add-favorite-player', [
            'allPlayers' => $allPlayers,
            'favoritePlayers' => $favoritePlayers,
        ]);
    }

    public function toggleFavorite($playerId)
    {
        $user = auth()->user();

        if ($user->favoritePlayers()->where('player_id', $playerId)->exists()) {
            $user->favoritePlayers()->detach($playerId);
        } else {
            $user->favoritePlayers()->attach($playerId);
        }

        $this->dispatch('favoriteToggled');
        $this->dispatch('notifyAlert', message: 'Joueur ajouté à vos favoris', type: 'success');
    }
}
