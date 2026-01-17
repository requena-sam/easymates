<?php

namespace App\Livewire\Players;

use Illuminate\Support\Facades\Artisan;
use Livewire\Component;
use App\Models\Player;
use Illuminate\Support\Collection;

class StreamingSection extends Component
{
    public Collection $players;

    public function mount()
    {
        $this->loadPlayers();
    }

    public function loadPlayers()
    {
        Artisan::call('twitch:update-streams');
        $this->players = Player::where('is_streaming', true)->get();
    }

    public function render()
    {
        return view('livewire.players.streaming-section');
    }
}
