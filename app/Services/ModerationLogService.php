<?php

namespace App\Services;

use App\Enums\LogType;
use App\Models\ModerationLog;

class ModerationLogService
{

    public static function logDeletion(
        int     $staffId,
        string  $itemType,
        int     $itemId,
        ?string $reason = null,
        ?array  $metadata = null
    ): ModerationLog
    {
        return ModerationLog::create([
            'staff_id' => $staffId,
            'type' => LogType::DELETION,
            'item_type' => $itemType,
            'item_id' => $itemId,
            'reason' => $reason,
            'metadata' => $metadata
        ]);
    }


    public static function logReport(
        int     $staffId,
        int     $reportId,
        ?string $reason = null,
        ?array  $metadata = null
    ): ModerationLog
    {
        return ModerationLog::create([
            'staff_id' => $staffId,
            'type' => LogType::REPORT,
            'report_id' => $reportId,
            'reason' => $reason,
            'metadata' => $metadata
        ]);
    }


    public static function logUserRole(
        int     $staffId,
        int     $targetUserId,
        ?string $reason = null,
        ?array  $metadata = null
    ): ModerationLog
    {
        return ModerationLog::create([
            'staff_id' => $staffId,
            'type' => LogType::USER_ROLE,
            'target_id' => $targetUserId,
            'reason' => $reason,
            'metadata' => $metadata
        ]);
    }


    public static function getRecentLogs(int $perPage = 50)
    {
        return ModerationLog::with(['staff', 'target'])
            ->recent()
            ->paginate($perPage);
    }


    public static function getStaffLogs(int $staffId, int $perPage = 50)
    {
        return ModerationLog::with(['staff', 'target'])
            ->byStaff($staffId)
            ->recent()
            ->paginate($perPage);
    }


    public static function getLogsByType(LogType $type, int $perPage = 50)
    {
        return ModerationLog::with(['staff', 'target'])
            ->byType($type)
            ->recent()
            ->paginate($perPage);
    }

}
