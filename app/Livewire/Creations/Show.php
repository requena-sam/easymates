<?php

namespace App\Livewire\Creations;

use App\Models\Creation;
use App\Services\NotificationService;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{
    public $creation;
    public $creationId;
    public $isLiked = false;

    public function mount($creationId)
    {
        $this->creationId = $creationId;
        $this->loadCreation();
    }

    public function loadCreation()
    {
        $this->creation = Creation::with('user')->findOrFail($this->creationId);
        $this->isLiked = $this->creation->isLikedByUser(auth()->id());
    }

    #[On('creationUpdated')]
    public function refreshCreation()
    {
        $this->loadCreation();
    }

    public function toggleLike()
    {
        $this->isLiked = $this->creation->toggleLike(auth()->id());
        NotificationService::notifyLike($this->creation->user_id, auth()->id(), $this->creation->id);
        $this->dispatch('refreshCreationsList');
    }


    public function render()
    {
        return view('livewire.creations.show');
    }
}
