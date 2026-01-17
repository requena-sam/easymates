<?php

namespace App\Livewire\Players;

use App\Models\Player;
use Livewire\Component;

class PlayerCard extends Component
{
    public Player $player;

    public function mount(Player $player)
    {
        $this->player = $player;
    }

    public function render()
    {
        return view('livewire.players.player-card');
    }
}
