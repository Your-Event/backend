<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model
{
    protected $fillable = [
        'title',
        'locale',
    ];

    public function postTypeTranslations(): HasMany
    {
        return $this->hasMany(PostTypeTranslation::class, 'lang_id');
    }

    public function postSubTypeTranslations(): HasMany
    {
        return $this->hasMany(PostSubTypeTranslation::class, 'lang_id');
    }

    public function postUnitTranslations(): HasMany
    {
        return $this->hasMany(PostUnitTranslation::class, 'lang_id');
    }

    public function roleTranslations(): HasMany
    {
        return $this->hasMany(RoleTranslation::class, 'lang_id');
    }
}
