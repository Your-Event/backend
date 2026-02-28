<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostBusyDateTime extends Model
{
    use HasFactory;

    protected $table = 'post_busy_date_time';

    protected $fillable = [
        'post_id',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Relation to Post
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
