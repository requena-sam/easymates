<?php

namespace App\Services;

use App\Enums\ReportReason;
use App\Models\Report;
use Illuminate\Database\Eloquent\Model;

class ReportService
{
    public function createReport(int $reporterId, Model $reportable, ReportReason $reason): Report
    {
        return Report::create([
            'reporter_id' => $reporterId,
            'reported_user_id' => $reportable->user_id,
            'reportable_type' => get_class($reportable),
            'reportable_id' => $reportable->id,
            'reason' => $reason,
            'status' => 'pending',
        ]);
    }

    public function hasAlreadyReported(int $reporterId, Model $reportable): bool
    {
        return Report::where('reporter_id', $reporterId)
            ->where('reportable_type', get_class($reportable))
            ->where('reportable_id', $reportable->id)
            ->exists();
    }

    public function resolveReport(Report $report): void
    {
        $report->markAsResolved();
    }

}
