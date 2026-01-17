<?php

namespace App\Livewire\Events;

use Livewire\Component;

class ActionsBtn extends Component
{
    public $eventId;

    public function mount($elementId): void
    {
        $this->eventId = $elementId;
    }

    public function render()
    {
        return view('livewire.events.actions-btn');
    }
}
