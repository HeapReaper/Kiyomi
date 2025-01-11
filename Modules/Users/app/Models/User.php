<?php

namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Flights\Models\Flight;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable
{
    use HasFactory, HasRoles, Notifiable, \Illuminate\Auth\Passwords\CanResetPassword;
	
	protected $table = 'users';

    protected string $guard_name = 'web';
	
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
        'knvvl',
        'instruct',
        'has_plane_brevet',
        'has_helicopter_brevet',
        'has_glider_brevet',
        'has_drone_a1',
        'has_drone_a2',
        'has_drone_a3',
        'in_memoriam',
    ];
	
    protected $hidden = [
        'password',
        'remember_token',
    ];
	
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
	
    public function flight(): belongsToMany
    {
        return $this->belongsToMany(Flight::class, 'flight_model');
    }
}
