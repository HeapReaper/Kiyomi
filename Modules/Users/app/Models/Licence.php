<?php

namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    protected $table = 'licenses';

    protected $fillable = [
        'id',
        'rc_motorplane',
        'rc_helicopter',
        'rc_glider',
        'rc_multicopter',
        'drone_a1',
        'drone_a2',
        'drone_a3',
    ];
}
