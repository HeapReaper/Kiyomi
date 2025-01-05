<?php

namespace Modules\Flights\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SubmittedModel extends Model
{
    protected $table = 'flight_submitted_model';
	
    protected $fillable = [
        'id',
        'model_type',
        'class',
        'lipo_count',
    ];
	
    public function flight(): belongsToMany
    {
        return $this->belongsToMany(Flight::class, 'flight_model');
    }
}
