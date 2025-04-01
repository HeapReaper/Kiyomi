<?php

namespace Modules\Articles\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'metadata',
        'published_at',
        'timestamps',
        'deleted_at',
    ];
}
