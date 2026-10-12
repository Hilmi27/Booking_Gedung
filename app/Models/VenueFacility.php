<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class VenueFacility extends Pivot
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'venue_id',
        'facility_id',
    ];
}