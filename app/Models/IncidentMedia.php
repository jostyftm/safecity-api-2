<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IncidentMedia extends Model
{
    /** @use HasFactory<\Database\Factories\IncidentMediaFactory> */
    use HasFactory;

    protected $fillable = [
        'incident_id',
        'media_type',
        'url',
    ];

    /**
     * Get the incident that owns the media.
     * 
     * @return BelongsTo<Incident>
     */
    public function incident(): BelongsTo
    {
        return $this->belongsTo(Incident::class);
    }
}
