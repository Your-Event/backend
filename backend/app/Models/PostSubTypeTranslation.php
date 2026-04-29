<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostSubTypeTranslation extends Model
{
    protected $fillable = [
        'lang_id',
        'post_sub_type_id',
        'title',
    ];

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }

    public function postSubType(): BelongsTo
    {
        return $this->belongsTo(PostSubType::class, 'post_sub_type_id');
    }
}
