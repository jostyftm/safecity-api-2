<?php

namespace App\Models;

use Clickbar\Magellan\Data\Geometries\Polygon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    /** @use HasFactory<\Database\Factories\CityFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'province_id',
        'boundary',
    ];

    protected $casts = [
        'boundary'  => Polygon::class
    ];

    /**
     * Get the province that owns the city.
     * 
     * @return BelongsTo<Province>
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    /**
     * Get the availability zones associated with the control entity.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function availabilyZones(): HasMany
    {
        return $this->hasMany(AvailabilyZone::class);
    }
}
