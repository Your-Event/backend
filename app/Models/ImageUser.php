<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ImageUser extends Pivot
{
    protected $table = 'images_user';

    protected $fillable = [
        'user_id',
        'image_id',
    ];

    public $timestamps = true;
}
