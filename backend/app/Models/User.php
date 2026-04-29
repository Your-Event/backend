<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser, HasName
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'email',
        'email_verified_at',
        'password',
        'user_type',
        'role_id',
        'full_name',
        'gender',
        'image_path',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }

    public function phones()
    {
        return $this->hasMany(UserPhone::class);
    }

    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }

    public function client(): HasOne
    {
        return $this->hasOne(Client::class);
    }

    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }

    public function showman(): HasOne
    {
        return $this->hasOne(Showman::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function favoritePosts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'favorite_posts', 'user_id', 'post_id')
            ->withTimestamps();
    }

    public function galleryImages(): BelongsToMany
    {
        return $this->belongsToMany(Image::class, 'images_user', 'user_id', 'image_id')
            ->withTimestamps();
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->email === 'admin@yourevent.com';
    }

    public function getFilamentName(): string
    {
        return $this->email;
    }

    public function getNameAttribute(): string
    {
        return $this->email;
    }
}
