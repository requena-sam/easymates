<?php

namespace App\Livewire\Creations;

use App\Models\Creation;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{
    public $creation;
    public $creationId;

    public function mount($creationId)
    {
        $this->creationId = $creationId;
        $this->loadCreation();
    }

    public function loadCreation()
    {
        $this->creation = Creation::with('user')->findOrFail($this->creationId);
    }

    #[On('creationUpdated')]
    public function refreshCreation()
    {
        $this->loadCreation();
    }

    public function delete()
    {
        $creation = Creation::findOrFail($this->creationId);
        $creation->delete();

        $this->dispatch('closeModal');
        $this->dispatch('creationDeleted');
        $this->dispatch('showAlert', [
            'type' => 'success',
            'message' => 'Création supprimée avec succès!'
        ]);
        redirect()->route('creations');
    }

    public function render()
    {
        return view('livewire.creations.show');
    }
}
