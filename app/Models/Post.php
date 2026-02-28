<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'is_verified',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
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

    /**
     * Relation to PriceUnitTranslation
     */
    public function priceUnit(): BelongsTo
    {
        return $this->belongsTo(PriceUnit::class, 'price_unit_id');
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
        return $this->belongsToMany(User::class, 'favorite_post', 'post_id', 'user_id')
            ->withTimestamps();
    }
}
