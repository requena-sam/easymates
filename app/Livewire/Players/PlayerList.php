<?php

namespace App\Livewire\Players;

use Livewire\Component;
use Illuminate\Support\Collection;

class PlayerList extends Component
{
    public Collection $players;

    public function mount(Collection $players)
    {
        $this->players = $players;
    }

    public function render()
    {
        return view('livewire.players.player-list');
    }
}
