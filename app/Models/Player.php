<?php

namespace App\Models;

use App\Enums\GameColors;
use App\Services\ImageService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'pseudo',
        'first_name',
        'last_name',
        'game_name',
        'player_number',
        'description',
        'profile_picture_uuid',
        'role',
        'twitch',
        'youtube',
        'twitter',
        'instagram',
        'is_streaming',
        'viewer_count',
    ];

    protected $casts = [
        'is_streaming' => 'boolean',
        'viewer_count' => 'integer',
    ];

    public function getProfilePictureUrl(string $size = 'medium'): ?string
    {
        if (!$this->profile_picture_uuid) {
            return asset('images/default-avatar.png');
        }

        return app(ImageService::class)->getUrl($this->profile_picture_uuid, $size);
    }


    public function getGameColor(): string
    {
        return GameColors::getColor($this->game_name);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }


    public function scopeStreaming($query)
    {
        return $query->where('is_streaming', true);
    }

    public function scopeByGame($query, string $gameName)
    {
        return $query->where('game_name', $gameName);
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
        static::deleting(function ($player) {
            if ($player->profile_picture_uuid) {
                app(ImageService::class)->delete($player->profile_picture_uuid);
            }
        });
    }
}
