<?php

namespace App\Models;

use App\Services\ImageService;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements CanResetPassword
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }


    public function getProfilePictureUrl(string $size = 'medium'): string
    {
        if ($this->profile_picture) {
            return app(ImageService::class)->getUrl($this->profile_picture, $size);
        }

        return asset('images/default-avatar.png');
    }

    public function deleteOldProfilePicture(): void
    {
        if ($this->profile_picture && Storage::exists($this->profile_picture)) {
            Storage::delete($this->profile_picture);
        }
    }


    public function favoritePlayers()
    {
        return $this->belongsToMany(Player::class, 'favorite_players')
            ->withTimestamps();
    }

    public function creations()
    {
        return $this->hasMany(Creation::class);
    }

    public function coHostings()
    {
        return $this->hasMany(CoHosting::class);
    }


    public function carpools()
    {
        return $this->hasMany(Carpool::class);
    }

    public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class);
    }

    public function unreadNotifications()
    {
        return $this->hasMany(\App\Models\Notification::class)
            ->where('is_read', false)
            ->orderBy('created_at', 'desc');
    }
}
