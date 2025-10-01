<?php

namespace App\Models;

use Clickbar\Magellan\Data\Geometries\Polygon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    /** @use HasFactory<\Database\Factories\ProvinceFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'boundary',
    ];

    protected $casts = [
        'boundary'  => Polygon::class
    ];

    /**
     * Get the cities for the province.
     * 
     * @return HasMany<City>
     */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
}
