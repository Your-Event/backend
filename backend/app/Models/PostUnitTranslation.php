<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostUnitTranslation extends Model
{
    protected $fillable = [
        'lang_id',
        'post_unit_id',
        'title',
    ];

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }

    public function postUnit(): BelongsTo
    {
        return $this->belongsTo(PostUnit::class);
    }
}
