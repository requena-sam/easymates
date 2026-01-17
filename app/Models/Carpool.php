<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Carpool extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id',
        'departure_country',
        'departure_address',
        'arrival_address',
        'start_date',
        'end_date',
        'price_per_person',
        'available_spots',
        'whatsapp',
        'discord',
        'twitter',
        'instagram',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'price_per_person' => 'decimal:2',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
