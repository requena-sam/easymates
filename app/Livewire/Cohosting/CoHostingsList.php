<?php

namespace App\Livewire\Cohosting;

use App\Models\CoHosting;
use Livewire\Attributes\On;
use Livewire\Component;

class CoHostingsList extends Component
{
    public $eventId;

    public function mount($eventId)
    {
        $this->eventId = $eventId;
    }

    #[On('refreshHostingList')]
    public function refreshList()
    {
        $this->render();
    }

    public function render()
    {
        $coHostings = CoHosting::where('event_id', $this->eventId)
            ->with('user')
            ->latest()
            ->get();

        return view('livewire.cohosting.co-hostings-list', [
            'coHostings' => $coHostings
        ]);
    }
}
