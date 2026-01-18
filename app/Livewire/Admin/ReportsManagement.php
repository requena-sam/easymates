<?php

namespace App\Livewire\Admin;

use App\Models\Report;
use App\Services\ReportService;
use Livewire\Component;
use Livewire\WithPagination;

class ReportsManagement extends Component
{
    use WithPagination;

    public string $search = '';
    public string $statusFilter = 'all';
    public string $typeFilter = 'all';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }

    public function updatingTypeFilter(): void
    {
        $this->resetPage();
    }

    public function markAsResolved(int $reportId, ReportService $reportService): void
    {
        $report = Report::findOrFail($reportId);
        $reportService->resolveReport($report);
    }

    public function render()
    {
        $query = Report::with(['reporter', 'reportedUser', 'reportable'])
            ->when($this->search, function ($q) {
                $q->whereHas('reporter', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })->orWhereHas('reportedUser', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->statusFilter !== 'all', function ($q) {
                $q->where('status', $this->statusFilter);
            })
            ->when($this->typeFilter !== 'all', function ($q) {
                $modelClass = $this->typeFilter === 'creation'
                    ? 'App\Models\Creation'
                    : 'App\Models\CoHosting';
                $q->where('reportable_type', $modelClass);
            })
            ->latest();

        return view('livewire.admin.reports-management', [
            'reports' => $query->paginate(15),
        ]);
    }
}
