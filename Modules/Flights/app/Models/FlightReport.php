<?php

namespace Modules\Flights\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FlightReport extends Model
{
	protected $table = 'flight_reports';
	
    protected $fillable = [
		'id',
		'made_by',
		'report_start_date',
		'report_end_date',
		'date',
		'file'
	];
}
