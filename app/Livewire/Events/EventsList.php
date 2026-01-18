<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Livewire\Attributes\On;
use Livewire\Component;

class EventsList extends Component
{
    #[On('eventAdded')]
    public function refresh(){
        $this->render();
    }
    public function render()
    {
        $events = Event::orderBy('start_date', 'asc')->get();

        return view('livewire.events.events-list', [
            'events' => $events
        ]);
    }
}
