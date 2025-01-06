<?php

namespace Modules\Flights\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Users\Models\User;

class Flight extends Model
{
    protected $fillable = [
        'id',
        'date',
        'start_time',
        'end_time',
        'model_type',
        'class',
    ];
	
    public function user(): belongsToMany
    {
        return $this->belongsToMany(User::class, 'flight_user');
    }
	
    public function submittedModel(): belongsToMany
    {
        return $this->belongsToMany(SubmittedModel::class, 'flight_model');
    }
}
