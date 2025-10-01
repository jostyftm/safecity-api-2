<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ControlEntity extends Model
{
    /** @use HasFactory<\Database\Factories\ControlEntityFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone'
    ];

    /**
     * Get the users associated with the control entity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'control_entity_users', 'control_entity_id', 'user_id')
            ->withTimestamps();
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
