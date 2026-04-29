<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PostUnit extends Model
{
    protected $table = 'post_units';

    protected $fillable = [
        'title',
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(PostUnitTranslation::class, 'post_unit_id');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'price_unit_id');
    }
}
