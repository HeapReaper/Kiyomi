<?php

namespace Modules\Flights\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Flights\Database\Factories\FlightFactory;

class Flight extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id',
        'date_time',
        'model_type',
        'class',
        'lipo_count',
    ];
}
