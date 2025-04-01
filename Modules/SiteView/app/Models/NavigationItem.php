<?php

namespace Modules\SiteView\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\hasMany;

class NavigationItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'position',
        'parent_id',
    ];

    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(NavigationItem::class, 'parent_id');
    }
}
