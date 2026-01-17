<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    public static function notifyLike(int $creationOwnerId, int $likerId, int $creationId)
    {
        if ($creationOwnerId === $likerId) {
            return null;
        }

        return Notification::create([
            'user_id' => $creationOwnerId,
            'type' => 'like',
            'actor_id' => $likerId,
            'target_id' => $creationId,
        ]);
    }

    public static function notifyComment(int $creationOwnerId, int $commenterId, int $creationId)
    {
        if ($creationOwnerId === $commenterId) {
            return null;
        }

        return Notification::create([
            'user_id' => $creationOwnerId,
            'type' => 'comment',
            'actor_id' => $commenterId,
            'target_id' => $creationId,
        ]);
    }

    public static function notifyDeletion(int $userId, int $creationId, string $reason)
    {
        return Notification::create([
            'user_id' => $userId,
            'type' => 'deletion',
            'target_id' => $creationId,
            'reason' => $reason,
        ]);
    }
    public static function markAllAsRead(int $userId)
    {
        return Notification::where('user_id', $userId)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now()
            ]);
    }

    public static function getUnreadCount(int $userId)
    {
        return Notification::where('user_id', $userId)
            ->unread()
            ->count();
    }
}
