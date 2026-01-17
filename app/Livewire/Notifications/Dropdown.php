<?php

namespace App\Livewire\Notifications;

use App\Models\Notification;
use App\Services\NotificationService;
use Livewire\Attributes\On;
use Livewire\Component;

class Dropdown extends Component
{
    public $unreadCount = 0;
    public $notifications = [];

    public function mount()
    {
        $this->updateNotifications();
    }

    #[On('notificationCreated')]
    public function updateNotifications()
    {
        if (auth()->check()) {
            $this->unreadCount = NotificationService::getUnreadCount(auth()->id());
            $this->notifications = Notification::where('user_id', auth()->id())
                ->with(['actor', 'target'])
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        }
    }

    public function markAsRead($notificationId)
    {
        $notification = Notification::where('id', $notificationId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $notification->markAsRead();
        $this->updateNotifications();

        $this->dispatch('notificationUpdated');
    }

    public function markAllAsRead()
    {
        NotificationService::markAllAsRead(auth()->id());
        $this->updateNotifications();

        $this->dispatch('notificationUpdated');

        $this->dispatch('notifyAlert', message: 'Toutes les notifications ont été marquées comme lues.', type: 'success');
    }

    public function delete($notificationId)
    {
        $notification = Notification::where('id', $notificationId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $notification->delete();
        $this->updateNotifications();

        $this->dispatch('notificationUpdated');
    }

    #[On('notificationUpdated')]
    public function refreshFromEvent()
    {
        $this->updateNotifications();
    }

    public function render()
    {
        return view('livewire.notifications.dropdown');
    }
}
