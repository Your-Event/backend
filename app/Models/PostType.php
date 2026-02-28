<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PostType extends Model
{
    use HasFactory;

    protected $table = 'post_types';

    protected $fillable = [
        'title',
    ];

    /**
     * Relation to PostSubType
     */
    public function subTypes(): HasMany
    {
        return $this->hasMany(PostSubType::class, 'post_type_id');
    }
}
