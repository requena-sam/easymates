<?php

namespace App\Livewire\Players;

use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Collection;

class PlayerList extends Component
{
    public Collection $players;

    public function mount(Collection $players)
    {
        $this->players = $players;
    }

    #[On('playerAdded')]
    public function refreshList(): void
    {
        $this->render();
    }

    public function render()
    {
        return view('livewire.players.player-list');
    }
}
