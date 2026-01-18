<?php

namespace App\Livewire\CoHosting;

use App\Models\CoHosting;
use Livewire\Component;

class DeleteConfirmation extends Component
{

    public $coHostingId;
    public $coHostingName;

    public function mount($elementId): void
    {
        $this->coHostingId = $elementId;

        $coHosting = CoHosting::find($elementId);
        $this->coHostingName = $coHosting ? $coHosting->title : 'ce co-hébergement';
    }

    public function delete()
    {
        $coHosting = CoHosting::findOrFail($this->coHostingId);
        $coHosting->delete();

        $this->dispatch('closeModal');
        $this->dispatch('refreshHostingList');
        $this->dispatch('notifyAlert', message: "Le co-hébergement '{$this->coHostingName}' a été supprimé avec succès.", type: 'success');
    }

    public function cancel(): void
    {
        $this->dispatch('closeEditModal');
    }

    public function render()
    {
        return view('livewire.cohosting.delete-confirmation');
    }
}
