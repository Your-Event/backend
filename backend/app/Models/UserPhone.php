<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPhone extends Model
{
    use HasFactory;

    protected $table = 'user_phones';

    protected $fillable = [
        'user_id',
        'phone',
        'phone_verified',
        'last_used_code',
        'shift_start',
        'shift_end',
    ];

    protected $casts = [
        'phone_verified' => 'datetime',
        'shift_start' => 'datetime:H:i',
        'shift_end' => 'datetime:H:i',
    ];

    /**
     * Relation to User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
