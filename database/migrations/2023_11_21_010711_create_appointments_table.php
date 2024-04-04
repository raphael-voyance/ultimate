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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            $table->enum('appointment_type',['pay', 'barter', 'free'])->default('pay');
            $table->enum('session_type', ['phone', 'tchat', 'writing'])->default('phone');

            $table->text('request_reason')->nullable();
            $table->text('request_message')->nullable();
            $table->boolean('request_approved')->default(false);
            $table->text('request_reply')->nullable();

            $table->json('appointment_message')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->unsignedBigInteger('time_slot_day_id')->nullable();
            $table->foreign('time_slot_day_id')->references('id')->on('time_slot_days');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
