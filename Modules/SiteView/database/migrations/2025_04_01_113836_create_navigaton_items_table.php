<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('navigaton_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url')->nullable();
            $table->integer('position')->default(0);
            $table->unsignedBigInteger('parent_id')->nullable(); // Explicitly define as unsignedBigInteger
            $table->timestamps();

            $table->foreign('parent_id')
                ->references('id')
                ->on('navigation_items')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('navigaton_items');
    }
};
