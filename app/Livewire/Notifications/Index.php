<?php

namespace App\Livewire\Notifications;

use App\Models\Notification;
use App\Services\NotificationService;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $unreadCount = 0;
    public $filter = 'all';

    public function mount()
    {
        $this->updateUnreadCount();
    }

    #[On('notificationCreated')]
    public function updateUnreadCount()
    {
        $this->unreadCount = NotificationService::getUnreadCount(auth()->id());
    }

    public function markAsRead($notificationId)
    {
        $notification = Notification::where('id', $notificationId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $notification->markAsRead();
        $this->updateUnreadCount();

        $this->dispatch('notificationUpdated');
    }

    public function markAsUnread($notificationId)
    {
        $notification = Notification::where('id', $notificationId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $notification->markAsUnread();
        $this->updateUnreadCount();

        $this->dispatch('notificationUpdated');
    }

    public function markAllAsRead()
    {
        NotificationService::markAllAsRead(auth()->id());
        $this->updateUnreadCount();

        $this->dispatch('notificationUpdated');

        $this->dispatch('notifyAlert', message: 'Toutes les notifications ont été marquées comme lues.', type: 'success');
    }

    public function delete($notificationId)
    {
        $notification = Notification::where('id', $notificationId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $notification->delete();
        $this->updateUnreadCount();

        $this->dispatch('notificationUpdated');
    }

    #[On('notificationUpdated')]
    public function refreshFromEvent()
    {
        $this->updateUnreadCount();
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
        $this->resetPage();
    }

    public function render()
    {
        $query = Notification::where('user_id', auth()->id())
            ->with(['actor', 'target'])
            ->recent();

        if ($this->filter === 'unread') {
            $query->unread();
        } elseif ($this->filter === 'read') {
            $query->read();
        }

        $notifications = $query->paginate(15);

        return view('livewire.notifications.index', [
            'notifications' => $notifications
        ]);
    }
}
