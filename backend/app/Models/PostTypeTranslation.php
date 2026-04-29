<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostTypeTranslation extends Model
{
    protected $fillable = [
        'lang_id',
        'post_type_id',
        'title',
    ];

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }

    public function postType(): BelongsTo
    {
        return $this->belongsTo(PostType::class);
    }
}
