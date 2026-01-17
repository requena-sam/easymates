<?php

namespace App\Livewire\Notifications;

use App\Models\Notification;
use Livewire\Component;

class DeleteAllConfirmation extends Component
{
    public function confirmDeleteAll()
    {
        Notification::where('user_id', auth()->id())->delete();
        $this->dispatch('closeModal');
        $this->dispatch('notificationUpdated');
        $this->dispatch('notifyAlert', message: 'Toutes les notifications ont été supprimées avec succès.', type: 'success');
    }

    public function render()
    {
        return view('livewire.notifications.delete-all-confirmation');
    }
}
