<?php

namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Modules\Users\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Flights\Models\Flight;

class User extends Authenticatable
{
    use HasFactory, HasRoles;

    protected $table = 'users';
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array <int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'birthdate',
        'address',
        'zip_code',
        'city',
        'mobile_phone',
        'rdw_number',
        'instruct',
        'has_plane_brevet',
        'has_helicopter_brevet',
        'has_glider_brevet',
        'has_drone_a1',
        'has_drone_a2',
        'has_drone_a3',
        'in_memoriam',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * User to flight submit relationship
     *
     * @author AutiCodes
     * @return BelongsToMany
     */
    public function flight(): belongsToMany
    {
        return $this->belongsToMany(Flight::class, 'flight_model');
    }
}
