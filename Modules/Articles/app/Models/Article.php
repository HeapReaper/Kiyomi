<?php

namespace Modules\Articles\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Articles\Models\Category;
use Modules\Users\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Article extends Model
{
    use HasFactory;

    protected $casts = [
       'published' => 'boolean',
    ];

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'metadata',
        'published',
        'created_at',
        'deleted_at',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'article_category');
    }
}
