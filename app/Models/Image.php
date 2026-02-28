<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = [
        'path',
    ];

    /**
     * Many-to-Many relation with Users
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'images_user', 'image_id', 'user_id')
            ->withTimestamps();
    }
    /**
     * @return BelongsToMany
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_images', 'image_id', 'post_id')
            ->withTimestamps();
    }
}
