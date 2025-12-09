<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'game_name',
        'address',
        'country',
        'start_date',
        'end_date',
        'description',
        'image_path',
        'official_ticketing_link',
        'secondary_ticketing_link',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'image_path' => 'array',
    ];

    public function coHostingAnnouncements(): HasMany
    {
        return $this->hasMany(CoHosting::class);
    }

    public function carpoolAnnouncements(): HasMany
    {
        return $this->hasMany(Carpool::class);
    }

    public function getImageUrl($size = 'medium')
    {
        $imagePath = is_array($this->image_path)
            ? $this->image_path
            : json_decode($this->image_path, true);

        if (!$imagePath || !isset($imagePath['sizes'][$size])) {
            return null;
        }

        return asset($imagePath['sizes'][$size]);
    }

    public function getImageSizes()
    {
        return $this->image_path['sizes'] ?? [];
    }


    public function getImageFolder()
    {
        return $this->image_path['folder'] ?? null;
    }
}
