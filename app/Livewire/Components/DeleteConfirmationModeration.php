<?php

namespace App\Livewire\Components;

use App\Models\CoHosting;
use App\Models\Creation;
use App\Services\ModerationLogService;
use App\Services\NotificationService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class DeleteConfirmationModeration extends Component
{
    use AuthorizesRequests;

    public $elementId;
    public $itemType;
    public $itemName;
    public $ownerName;
    public $ownerId;
    public $reason = '';

    protected $rules = [
        'reason' => 'required|string|min:10|max:500',
    ];

    protected $messages = [
        'reason.required' => 'La raison de la suppression est obligatoire.',
        'reason.min' => 'La raison doit contenir au moins 10 caractères.',
        'reason.max' => 'La raison ne peut pas dépasser 500 caractères.',
    ];

    public function mount($elementId, $itemType)
    {

        $this->elementId = $elementId;
        $this->itemType = $itemType;

        if ($itemType === 'creation') {
            $creation = Creation::findOrFail($elementId);
            $this->itemName = $creation->title;
            $this->ownerName = $creation->user->name;
            $this->ownerId = $creation->user_id;
        } elseif ($itemType === 'cohosting') {
            $cohosting = CoHosting::findOrFail($elementId);
            $this->itemName = $cohosting->title;
            $this->ownerName = $cohosting->user->name;
            $this->ownerId = $cohosting->user_id;
        }
    }

    public function delete()
    {
        $this->validate();

        try {
            if ($this->itemType === 'creation') {
                $creation = Creation::findOrFail($this->elementId);

                NotificationService::notifyDeletion(
                    $this->ownerId,
                    $this->elementId,
                    $this->reason
                );

                ModerationLogService::logDeletion(
                    auth()->id(),
                    'creation',
                    $this->elementId,
                    $this->reason,
                    [
                        'title' => $creation->title,
                        'owner_id' => $this->ownerId,
                        'owner_name' => $this->ownerName,
                    ]
                );

                $creation->delete();
                $this->dispatch('closeEditModal');
                $this->dispatch('closeModal');
                $this->dispatch('refreshCreationsList');
                $this->dispatch('notifyAlert', message: 'Création supprimée avec succes', type: 'success');
                return redirect()->route('creations');


            } elseif ($this->itemType === 'cohosting') {
                $cohosting = CoHosting::findOrFail($this->elementId);

                // Créer la notification pour l'utilisateur
                NotificationService::notifyDeletion(
                    $this->ownerId,
                    $this->elementId,
                    $this->reason
                );

                // Créer le log de modération
                ModerationLogService::logDeletion(
                    auth()->id(),
                    'cohosting',
                    $this->elementId,
                    $this->reason,
                    [
                        'title' => $cohosting->title,
                        'owner_id' => $this->ownerId,
                        'owner_name' => $this->ownerName,
                    ]
                );

                // Supprimer le co-hébergement
                $cohosting->delete();
                $this->dispatch('closeEditModal');
                $this->dispatch('closeModal');
                $this->dispatch('coHostingDeleted');
                $this->dispatch('notifyAlert', message: 'Co-hébergement supprimé avec succes', type: 'success');
            }

        } catch (\Exception $e) {
            $this->dispatch('closeEditModal');
        }
    }

    public function cancel()
    {
        $this->dispatch('closeEditModal');
    }

    public function render()
    {
        return view('livewire.components.delete-confirmation-moderation');
    }
}
