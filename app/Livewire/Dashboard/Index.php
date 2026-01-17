<?php

namespace App\Livewire\Dashboard;

use App\Models\Event;
use Illuminate\Support\Facades\Artisan;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['favoriteToggled' => '$refresh'];

    public function mount()
    {
        $this->loadPlayers();
    }

    public function loadPlayers()
    {
        Artisan::call('twitch:update-streams');
    }

    #[On('coHostingDeleted')]
    public function listRefresh()
    {
        $this->render();
    }

    public function render()
    {
        $upcomingEvents = Event::where('start_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->take(3)
            ->get();

        $myCreations = auth()->user()->creations()
            ->latest()
            ->take(3)
            ->get();

        $myCoHostings = auth()->user()->coHostings()
            ->where('end_date', '>=', now())
            ->latest()
            ->get();

        $myCarpools = auth()->user()->carpools()
            ->where('end_date', '>=', now())
            ->latest()
            ->get();

        $favoritePlayers = auth()->user()->favoritePlayers()
            ->orderBy('favorite_players.created_at', 'desc')
            ->get();

        return view('livewire.dashboard.index', [
            'upcomingEvents' => $upcomingEvents,
            'myCreations' => $myCreations,
            'myCoHostings' => $myCoHostings,
            'myCarpools' => $myCarpools,
            'favoritePlayers' => $favoritePlayers,
        ]);
    }
}
