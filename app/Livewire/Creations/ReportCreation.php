<?php

namespace App\Livewire\Creations;

use App\Enums\ReportReason;
use App\Models\Creation;
use App\Services\ReportService;
use Livewire\Component;

class ReportCreation extends Component
{
    public Creation $creation;
    public ?string $reason = null;
    public ?string $additionalInfo = null;

    protected $rules = [
        'reason' => 'required|string',
        'additionalInfo' => 'nullable|string|max:1000',
    ];

    public function mount(int $creationId): void
    {
        $this->creation = Creation::findOrFail($creationId);
    }

    public function submit(ReportService $reportService): void
    {
        $this->validate();

        if ($reportService->hasAlreadyReported(auth()->id(), $this->creation)) {
            session()->flash('error', 'Vous avez déjà signalé cette création.');
            $this->dispatch('closeModal');
            return;
        }

        $reportService->createReport(
            auth()->id(),
            $this->creation,
            ReportReason::from($this->reason),
        );
        $this->dispatch('notifyAlert', message: 'La création a été signalée avec succès.', type: 'success');
        $this->dispatch('closeModal');
    }

    public function render()
    {
        return view('livewire.creations.report-creation');
    }
}
