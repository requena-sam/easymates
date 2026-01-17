<?php

namespace App\Livewire\CoHosting;

use App\Models\CoHosting;
use App\Traits\HasImages;
use Livewire\Component;

class Show extends Component
{
    use HasImages;

    public $coHosting;
    public $coHostingId;

    public function mount($coHostingId)
    {
        $this->coHostingId = $coHostingId;
        $this->loadCoHosting();
    }

    public function loadCoHosting()
    {
        $this->coHosting = CoHosting::with(['user', 'event'])->findOrFail($this->coHostingId);
    }

    public function delete()
    {
        $coHosting = CoHosting::findOrFail($this->coHostingId);

        if ($coHosting->user_id !== auth()->id()) {
            $this->dispatch('notifyAlert', message: 'Vous n\'êtes pas autorisé à supprimer cette annonce.', type: 'error');
            return;
        }

        if (!empty($coHosting->image_uuids)) {
            $this->deleteImages($coHosting->image_uuids);
        }

        $coHosting->delete();

        $this->dispatch('closeModal');
        $this->dispatch('coHostingDeleted');
        $this->dispatch('notifyAlert', message: 'Annonce supprimée avec succès!', type: 'success');
    }

    public function render()
    {
        return view('livewire.cohosting.show');
    }
}
