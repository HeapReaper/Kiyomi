<?php

namespace Modules\Memberships\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\belongsToMany;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class Membership extends Model
{
    use HasFactory, HasRoles;

    protected string $guard_name = 'web';

    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'payment_frequency',
        'active',
        'created_at',
        'updated_at',
    ];

    public function hasCustomRole(string $role): bool
    {
        return $this->roles()->where('name', $role)->exists();
    }
}
