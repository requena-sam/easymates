<?php


namespace App\Models;

use App\Services\ImageService;
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
        'image_uuid',
        'official_ticketing_link',
        'secondary_ticketing_link',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function coHostingAnnouncements(): HasMany
    {
        return $this->hasMany(CoHosting::class);
    }

    public function carpoolAnnouncements(): HasMany
    {
        return $this->hasMany(Carpool::class);
    }


    public function getImageUrl(string $size = 'medium'): ?string
    {
        if (!$this->image_uuid) {
            return null;
        }

        return app(ImageService::class)->getUrl($this->image_uuid, $size);
    }


    public function getImageUrls(): array
    {
        if (!$this->image_uuid) {
            return [];
        }

        return app(ImageService::class)->getAllUrls($this->image_uuid);
    }


    protected static function booted()
    {
        static::deleting(function ($event) {
            if ($event->image_uuid) {
                app(ImageService::class)->delete($event->image_uuid);
            }
        });
    }
}
