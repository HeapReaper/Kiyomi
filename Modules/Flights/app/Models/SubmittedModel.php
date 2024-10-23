<?php

namespace Modules\Flights\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Flights\Models\Flight;

class SubmittedModel extends Model
{
    use HasFactory;

    protected $table = 'flight_submitted_model';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id',
        'model_type',
        'class',
        'lipo_count',
    ];

    /**
     * Submitted model to submitted form relationshup
     *
     * @author AutiCodes
     * @return BelongsToMany
     */
    public function flight(): belongsToMany
    {
        return $this->belongsToMany(Flight::class, 'flight_model');
    }
}
