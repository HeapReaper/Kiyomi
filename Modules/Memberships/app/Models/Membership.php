<?php

namespace Modules\Memberships\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Membership extends Model
{
    use HasFactory;

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
}
