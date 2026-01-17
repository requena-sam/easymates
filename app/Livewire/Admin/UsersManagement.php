<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Services\ModerationLogService;
use Livewire\Component;
use Livewire\WithPagination;

class UsersManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $roleFilter = 'all';
    public $availableRoles = ['admin', 'moderator', 'user'];

    public function updateUserRole($userId, $newRole)
    {
        $user = User::findOrFail($userId);

        if ($user->id === auth()->id()) {
            $this->dispatch('showAlert', [
                'type' => 'error',
                'message' => 'Vous ne pouvez pas modifier votre propre rôle.'
            ]);
            return;
        }

        $oldRole = $user->roles->first()?->name ?? 'user';

        if ($oldRole === $newRole) {
            return;
        }

        $user->syncRoles([]);

        $user->assignRole($newRole);

        ModerationLogService::logUserRole(
            staffId: auth()->id(),
            targetUserId: $user->id,
            reason: "Changement de rôle: {$oldRole} → {$newRole}",
            metadata: [
                'target_name' => $user->name,
                'target_email' => $user->email,
                'old_role' => $oldRole,
                'new_role' => $newRole,
            ]
        );

        $this->dispatch('notifyAlert', message: "Le rôle de {$user->name} a été mis à jour avec succès.", type: 'success');

        $this->dispatch('refreshLogsList');
    }

    public function render()
    {
        $query = User::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        // Filtre role
        if ($this->roleFilter !== 'all') {
            $query->role($this->roleFilter);
        }

        $users = $query->with('roles')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('livewire.admin.users-management', [
            'users' => $users,
        ]);
    }
}
