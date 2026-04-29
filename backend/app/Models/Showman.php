<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Showman extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'wall_image_id',
        'bio',
        'user_id',
    ];

    protected $with = ['user.role'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function wallImage(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'wall_image_id');
    }
}
