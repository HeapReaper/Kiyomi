<?php

namespace Modules\Flights\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Flights\Models\SubmittedModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Users\Models\User;

class Flight extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @author AutiCodes
     */
    protected $fillable = [
        'id',
        'date',
        'start_time',
        'end_time',
        'model_type',
        'class',
    ];

    /**
     * Submitted flight to user relationship
     *
     * @author AutiCodes
     * @return BelongsToMany
     */
    public function user(): belongsToMany
    {
        return $this->belongsToMany(User::class, 'flight_user');
    }

    /**
     * Submitted flight to submitted models relationship
     *
     * @author AutiCodes
     * @return BelongsToMany
     */
    public function submittedModel(): belongsToMany
    {
        return $this->belongsToMany(SubmittedModel::class, 'flight_model');
    }
}
