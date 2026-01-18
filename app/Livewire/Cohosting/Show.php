<?php

namespace App\Livewire\CoHosting;

use App\Models\CoHosting;
use App\Traits\HasImages;
use Livewire\Attributes\On;
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

    #[On('coHostingUpdated')]
    public function refreshCoHosting()
    {
        $this->loadCoHosting();
    }

    public function render()
    {
        return view('livewire.cohosting.show');
    }
}
