<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creation extends Model
{
    /** @use HasFactory<\Database\Factories\CreationFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'tags',
        'image_path',
        'likes_count',
        'comments_count',
    ];

    protected $casts = [
        'tags' => 'array',
        'image_path' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
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
