<?php

namespace Modules\Memberships\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Memberships\Database\Factories\MembershipFactory;

class Membership extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): MembershipFactory
    // {
    //     // return MembershipFactory::new();
    // }
}
