<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FavoritePost extends Pivot
{
    protected $table = 'favorite_post';

    protected $fillable = [
        'user_id',
        'post_id',
    ];

    public $timestamps = true;
}
