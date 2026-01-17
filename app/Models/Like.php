<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'creation_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creation()
    {
        return $this->belongsTo(Creation::class);
    }
}
