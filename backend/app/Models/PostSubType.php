<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PostSubType extends Model
{
    use HasFactory;

    protected $table = 'post_sub_types';

    protected $fillable = [
        'type_id',
        'title',
    ];

    /**
     * Relation to PostType
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(PostType::class, 'type_id');
    }

    /**
     * Relation to Posts
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'sub_type_id');
    }

    public function translations(): HasMany
    {
        return $this->hasMany(PostSubTypeTranslation::class, 'post_sub_type_id');
    }
}
