<?php

namespace App\Livewire\Players;

use App\Models\Player;
use Livewire\Attributes\On;
use Livewire\Component;

class PlayerCard extends Component
{
    public Player $player;

    public function mount(Player $player)
    {
        $this->player = $player;
    }

    #[On('playerUpdated')]
    public function refreshList()
    {
        $this->render();
    }

    public function render()
    {
        return view('livewire.players.player-card');
    }
}
