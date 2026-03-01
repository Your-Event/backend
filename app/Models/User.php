<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser, HasName
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    protected $appends = ['name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'email_verify',
        'password',
        'user_type',
        'role_id',
        'full_name',
        'gender',
        'image_path',
        'wall_image_path',
        'bio',
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
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function image()
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

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function showmens()
    {
        return $this->hasMany(Showman::class);
    }

    public function posts()
    {
        return $this->hasMany(Posts::class);
    }

    public function favoritePosts()
    {
        return $this->belongsToMany(Post::class, 'favorite_post', 'user_id', 'post_id')
            ->withTimestamps();
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->email === 'admin@example.com';
    }

    public function getFilamentName(): string
    {
        return $this->full_name ?? $this->email;
    }

    public function getNameAttribute(): string
    {
        return $this->full_name ?? $this->email;
    }

    public function getFilamentNameFor(): string
    {
        return $this->full_name ?? $this->email;
    }

}
