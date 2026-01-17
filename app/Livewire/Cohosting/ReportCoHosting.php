<?php

namespace App\Livewire\Cohosting;

use App\Enums\ReportReason;
use App\Models\CoHosting;
use App\Services\ReportService;
use Livewire\Component;

class ReportCoHosting extends Component
{
    public CoHosting $coHosting;
    public ?string $reason = null;
    public ?string $additionalInfo = null;

    protected $rules = [
        'reason' => 'required|string',
        'additionalInfo' => 'nullable|string|max:1000',
    ];

    public function mount(int $coHostingId): void
    {
        $this->coHosting = CoHosting::findOrFail($coHostingId);
    }

    public function submit(ReportService $reportService): void
    {
        $this->validate();

        if ($reportService->hasAlreadyReported(auth()->id(), $this->coHosting)) {
            $this->dispatch('closeModal');
            return;
        }

        $reportService->createReport(
            auth()->id(),
            $this->coHosting,
            ReportReason::from($this->reason),
        );

        $this->dispatch('notifyAlert', message: "Le co-hébergement '{$this->coHosting->title}' a été signalé avec succès.", type: 'success');
        $this->dispatch('closeModal');
    }

    public function render()
    {
        return view('livewire.cohosting.report-co-hosting');
    }
}
