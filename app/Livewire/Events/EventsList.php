<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Livewire\Component;

class EventsList extends Component
{
    public function render()
    {
        $events = Event::orderBy('start_date', 'desc')->get();

        return view('livewire.events.events-list', [
            'events' => $events
        ]);
    }
}
