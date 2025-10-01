<?php

namespace App\Models;

use Clickbar\Magellan\Data\Geometries\Point;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Incident extends Model
{
    /** @use HasFactory<\Database\Factories\IncidentFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'status',
        'reported_by',
        'assigned_to',
        'city_id',
        'location',
        'reported_at',
        'assigned_at',
        'verified_at',
    ];

    protected $casts = [
        'location'  => Point::class
    ];

    /**
     * Get the media associated with the incident.
     * 
     * @return HasMany<IncidentMedia>
     */
    public function media(): HasMany
    {
        return $this->hasMany(IncidentMedia::class);
    }
}
