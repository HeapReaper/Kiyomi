<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flight_reports', function (Blueprint $table) {
			$table->id();
			$table->string('made_by');
			$table->date('date');
			$table->string('file');
			$table->timestamps();
		});
    }
	
    public function down(): void
    {
        Schema::dropIfExists('flight_reports');
    }
};
