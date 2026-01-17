<?php

namespace App\Livewire\Carpool;

use App\Models\Carpool;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class DeleteConfirmation extends Component
{
    use AuthorizesRequests;

    public $carpoolId;
    public $carpoolName;

    public function mount($carpoolId)
    {
        $carpool = Carpool::findOrFail($carpoolId);
        $this->carpoolId = $carpool->id;
        $this->carpoolName = $carpool->departure_address . ' → ' . $carpool->arrival_address;
    }

    public function delete()
    {
        $carpool = Carpool::findOrFail($this->carpoolId);

        $carpool->delete();
        $this->dispatch('closeModal');
        $this->dispatch('carpoolRefresh');
        $this->dispatch('notifyAlert', message: "Le covoiturage '{$this->carpoolName}' a été supprimé avec succès.", type: 'success');
    }

    public function cancel()
    {
        $this->dispatch('closeModal');
    }

    public function render()
    {
        return view('livewire.carpool.delete-confirmation');
    }
}
