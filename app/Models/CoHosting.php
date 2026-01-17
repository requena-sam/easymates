<?php

namespace App\Models;

use App\Services\ImageService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CoHosting extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id',
        'title',
        'description',
        'image_uuids',
        'author_message',
        'available_spots',
        'start_date',
        'end_date',
        'address',
        'price_per_person',
        'listing_link',
        'whatsapp',
        'discord',
        'twitter',
        'instagram',
    ];

    protected $casts = [
        'image_uuids' => 'array',
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


    public function getThumbnailUrl(string $size = 'small'): ?string
    {
        if (empty($this->image_uuids) || !is_array($this->image_uuids)) {
            return null;
        }

        $firstUuid = $this->image_uuids[0] ?? null;

        if (!$firstUuid) {
            return null;
        }

        return app(ImageService::class)->getUrl($firstUuid, $size);
    }


    public function getImageUrls(string $size = 'medium'): array
    {
        if (empty($this->image_uuids) || !is_array($this->image_uuids)) {
            return [];
        }

        $imageService = app(ImageService::class);
        $urls = [];

        foreach ($this->image_uuids as $uuid) {
            $url = $imageService->getUrl($uuid, $size);
            if ($url) {
                $urls[] = $url;
            }
        }

        return $urls;
    }


    public function getAllImageUrls(): array
    {
        if (empty($this->image_uuids) || !is_array($this->image_uuids)) {
            return [];
        }

        $imageService = app(ImageService::class);
        $allUrls = [];

        foreach ($this->image_uuids as $uuid) {
            $allUrls[$uuid] = $imageService->getAllUrls($uuid);
        }

        return $allUrls;
    }


    protected static function booted()
    {
        static::deleting(function ($coHosting) {
            if (!empty($coHosting->image_uuids) && is_array($coHosting->image_uuids)) {
                app(ImageService::class)->deleteMultiple($coHosting->image_uuids);
            }
        });
    }
}
