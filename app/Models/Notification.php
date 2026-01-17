<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'actor_id',
        'target_id',
        'reason',
        'is_read',
        'read_at'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function actor()
    {
        return $this->belongsTo(User::class, 'actor_id');
    }

    public function target()
    {
        return $this->belongsTo(Creation::class, 'target_id');
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now()
        ]);
    }

    public function markAsUnread()
    {
        $this->update([
            'is_read' => false,
            'read_at' => null
        ]);
    }

    public function getMessage(): string
    {
        return match ($this->type) {
            'like' => $this->target
                ? "{$this->actor->name} a aimé votre création \"{$this->target->title}\""
                : "{$this->actor->name} a aimé votre création",
            'comment' => $this->target
                ? "{$this->actor->name} a commenté votre création \"{$this->target->title}\""
                : "{$this->actor->name} a commenté votre création",
            'follow' => "{$this->actor->name} a commencé à vous suivre",
            'live_started' => "{$this->actor->name} a commencé un live",
            'deletion' => "Votre création a été supprimée. Raison: {$this->reason}",
            default => "Nouvelle notification"
        };
    }
}
