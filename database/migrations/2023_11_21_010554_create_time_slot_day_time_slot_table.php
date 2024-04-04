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
        Schema::create('time_slot_day_time_slot', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('time_slot_day_id');
            $table->unsignedBigInteger('time_slot_id');

            $table->boolean('available')->default(true);

            $table->foreign('time_slot_day_id')->references('id')->on('time_slot_days')->onDelete('cascade');
            $table->foreign('time_slot_id')->references('id')->on('time_slots')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_slot_day_time_slot');
    }
};
