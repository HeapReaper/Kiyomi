<?php

namespace Modules\SiteView\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\hasMany;

class NavigationItem extends Model
{
    use HasFactory;

    protected $table = 'navbar_items';

    protected $fillable = [
    ];
}
