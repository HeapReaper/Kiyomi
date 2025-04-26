<?php

namespace Modules\Financials\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Financials\Database\Factories\FinanceFactory;

class Finance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): FinanceFactory
    // {
    //     // return FinanceFactory::new();
    // }
}
