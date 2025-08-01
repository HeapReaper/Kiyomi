<?php

namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Users\Database\Factories\InstructorFactory;

class Instructor extends Model
{
    use HasFactory;

    protected $table = 'instructor';

    protected $fillable = [
        'user_id',
        'model_type',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
