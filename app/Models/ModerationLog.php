<?php

namespace App\Models;

use App\Enums\LogType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModerationLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'type',
        'target_id',
        'item_type',
        'item_id',
        'report_id',
        'reason',
        'metadata'
    ];

    protected $casts = [
        'type' => LogType::class,
        'metadata' => 'array'
    ];

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function target()
    {
        return $this->belongsTo(User::class, 'target_id');
    }

    public function scopeByType($query, LogType $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByStaff($query, int $staffId)
    {
        return $query->where('staff_id', $staffId);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }


    public function getMessage(): string
    {
        $staffName = $this->staff->name ?? 'Staff inconnu';

        $data = match ($this->type) {
            LogType::DELETION => [
                'item_type' => $this->item_type ?? 'élément',
                'item_id' => $this->item_id
            ],
            LogType::REPORT => [
                'report_id' => $this->report_id
            ],
            LogType::USER_ROLE => [
                'target_name' => $this->target->name ?? 'Utilisateur inconnu',
                'target_id' => $this->target_id
            ],
        };

        return $staffName . ' ' . $this->type->getMessage($data);
    }

    public function getFormattedMetadata(): array
    {
        return $this->metadata ?? [];
    }
}
