<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('licences', function (Blueprint $table) {
            $table->id();
            $table->boolean('rc_motorplane');
            $table->boolean('rc_helicopter');
            $table->boolean('rc_glider');
            $table->boolean('rc_multicopter');
            $table->boolean('drone_a1');
            $table->boolean('drone_a2');
            $table->boolean('drone_a3');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('licences');
    }
};
