<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'sub_type_id',
        'user_id',
        'title',
        'description',
        'price',
        'price_unit_id',
        'modern',
        'is_verified',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'modern' => 'boolean',
        'is_verified' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Relation to User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation to PostSubType
     */
    public function subType(): BelongsTo
    {
        return $this->belongsTo(PostSubType::class, 'sub_type_id');
    }

    public function postUnit(): BelongsTo
    {
        return $this->belongsTo(PostUnit::class, 'price_unit_id');
    }

    public function busyDateTimes(): HasMany
    {
        return $this->hasMany(PostBusyDateTime::class, 'post_id');
    }

    /**
     * Relation to PostImage
     */
    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class, 'post_images', 'post_id', 'image_id')
            ->withTimestamps();
    }

    public function favoriteByUsers()
    {
        return $this->belongsToMany(User::class, 'favorite_posts', 'post_id', 'user_id')
            ->withTimestamps();
    }
}
