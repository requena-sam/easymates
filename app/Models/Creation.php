<?php

namespace App\Models;

use App\Services\ImageService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'tags',
        'image_uuid',
        'likes_count',
        'comments_count',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }


    public function isLikedByUser($userId): bool
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }


    public function toggleLike($userId): bool
    {
        $like = $this->likes()->where('user_id', $userId)->first();

        if ($like) {
            // Unlike
            $like->delete();
            $this->decrement('likes_count');
            return false;
        } else {
            // Like
            $this->likes()->create(['user_id' => $userId]);
            $this->increment('likes_count');
            return true;
        }
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
        static::deleting(function ($creation) {
            if ($creation->image_uuid) {
                app(ImageService::class)->delete($creation->image_uuid);
            }
        });
    }
}
