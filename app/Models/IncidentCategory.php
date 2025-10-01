<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentCategory extends Model
{
    /** @use HasFactory<\Database\Factories\IncidentCategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon',
    ];
}
