<?php

namespace Modules\Media\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Users\Models\User;

class Media extends Model
{
    use HasFactory;
    protected $table = 'media';

    protected $fillable = [
        'filename',
        's3_name',
        's3_path',
        'mime_type',
        'author_id',
        'coupled_to_id',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
