<?php

namespace App\Livewire\Carpool;

use App\Models\Carpool;
use Livewire\Component;

class CarpoolsList extends Component
{
    public $eventId;

    protected $listeners = ['carpoolRefresh' => '$refresh'];

    public function mount($eventId)
    {
        $this->eventId = $eventId;
    }

    public function render()
    {
        $carpools = Carpool::where('event_id', $this->eventId)
            ->with('user')
            ->latest()
            ->get();

        return view('livewire.carpool.carpools-list', [
            'carpools' => $carpools
        ]);
    }
}
