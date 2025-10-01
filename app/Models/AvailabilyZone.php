<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AvailabilyZone extends Model
{
    /** @use HasFactory<\Database\Factories\AvailabilyZoneFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'city_id',
        'area',
    ];

    /**
     * Get the control entity that owns the availability zone.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function controlEntity(): BelongsTo
    {
        return $this->belongsTo(ControlEntity::class);
    }

    /**
     * Get the city that owns the availability zone.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
