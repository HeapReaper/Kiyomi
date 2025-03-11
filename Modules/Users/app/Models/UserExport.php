<?php

namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Users\Database\Factories\UserExportFactory;

class UserExport extends Model
{
    use HasFactory;

    protected $table = 'users_export';

    protected $fillable = [
      'id',
      'file_name',
      'made_on',
      'made_by',
    ];

}
