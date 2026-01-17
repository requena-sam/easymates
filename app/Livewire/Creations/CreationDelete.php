<?php

namespace App\Livewire\Creations;

use App\Models\Creation;
use Livewire\Component;

class CreationDelete extends Component
{

    public $creationId;
    public $creationName;

    public function mount($elementId): void
    {
        $this->creationId = $elementId;

        $creation = Creation::find($elementId);
        $this->creationName = $creation ? $creation->title : 'cette création';
    }

    public function delete()
    {
        $creation = Creation::findOrFail($this->creationId);
        $creation->delete();

        $this->dispatch('closeModal');
        $this->dispatch('creationDeleted');
        $this->dispatch('notifyAlert', message: 'La création a été supprimée avec succès.', type: 'success');
        redirect()->route('creations');
    }

    public function cancel(): void
    {
        $this->dispatch('closeEditModal');
    }

    public function render()
    {
        return view('livewire.creations.creation-delete');
    }
}
