<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Livewire\Component;

class DeleteConfirmation extends Component
{
    public $eventId;
    public $eventName;

    public function mount($elementId): void
    {
        $this->eventId = $elementId;

        $event = Event::find($elementId);
        $this->eventName = $event ? $event->name : 'cet événement';
    }

    public function delete(): void
    {
        try {
            $event = Event::findOrFail($this->eventId);
            $event->delete();

            $this->dispatch('closeModal');
            $this->dispatch('notifyAlert', message: "L'événement '{$this->eventName}' a été supprimé avec succès.", type: 'success');

            $this->redirect(route('events.index'));

        } catch (\Exception $e) {
            $this->dispatch('notifyAlert', message: "Une erreur est survenue lors de la suppression de l'événement.", type: 'error');
        }
    }

    public function cancel(): void
    {
        $this->dispatch('closeModal');
    }

    public function render()
    {
        return view('livewire.events.delete-confirmation');
    }
}
