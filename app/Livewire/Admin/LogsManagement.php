<?php

namespace App\Livewire\Admin;

use App\Enums\LogType;
use App\Models\ModerationLog;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class LogsManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $typeFilter = 'all';
    public $staffFilter = 'all';

    protected $queryString = [
        'search' => ['except' => ''],
        'typeFilter' => ['except' => 'all'],
        'staffFilter' => ['except' => 'all'],
    ];

    #[On('refreshLogsList')]
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingTypeFilter()
    {
        $this->resetPage();
    }

    public function updatingStaffFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = ModerationLog::with(['staff', 'target'])
            ->orderBy('created_at', 'desc');

        if ($this->search) {
            $query->whereHas('staff', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->typeFilter !== 'all') {
            $query->where('type', $this->typeFilter);
        }

        if ($this->staffFilter !== 'all') {
            $query->where('staff_id', $this->staffFilter);
        }

        $logs = $query->paginate(15);

        $staffMembers = \App\Models\User::role(['admin', 'moderator'])
            ->orderBy('name')
            ->get();

        return view('livewire.admin.logs-management', [
            'logs' => $logs,
            'staffMembers' => $staffMembers,
        ]);
    }
}
