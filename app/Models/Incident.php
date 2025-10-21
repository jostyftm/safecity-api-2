<?php

namespace App\Models;

use Clickbar\Magellan\Data\Geometries\Point;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Incident extends Model
{
    /** @use HasFactory<\Database\Factories\IncidentFactory> */
    use HasFactory;

    protected $fillable = [
        // 'title',
        'description',
        'status',
        'category_id',
        'reported_by',
        'assigned_to',
        'location',
        'reported_at',
        'assigned_at',
        'verified_at',
    ];

    protected $casts = [
        'location'      => Point::class,
        'reported_at'   => 'datetime',
        'assigned_at'   => 'datetime',
        'verified_at'   => 'datetime',
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

    /**
     * Get the category associated with the incident.
     * 
     * @return BelongsTo<IncidentCategory>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(IncidentCategory::class, 'category_id');
    }

    /**
     * Get the user who reported the incident.
     * 
     * @return BelongsTo<User>
     */
    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reported_by');
    }

    /**
     * Get the user assigned to the incident.
     * 
     * @return BelongsTo<User>
     */
    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
