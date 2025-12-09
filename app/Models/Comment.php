<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'creation_id',
        'user_id',
        'content',
        'likes_count',
        'dislikes_count'
    ];

    protected $casts = [
        'is_answer' => 'boolean',
    ];

    public function creation()
    {
        return $this->belongsTo(Creation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
