<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PriceUnit extends Model
{
    use HasFactory;

    protected $table = 'price_units';

    protected $fillable = [
        'title',
    ];

    /**
     * Relation to PriceUnitTranslations
     */
    public function translations(): HasMany
    {
        return $this->hasMany(PriceUnit::class, 'price_unit_id');
    }
}
