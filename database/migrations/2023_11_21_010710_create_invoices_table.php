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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('total_price');
            $table->string('payment_invoice_token');
            $table->string('ref');
            $table->json('invoice_informations')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('appointment_id')->nullable();
            $table->enum('status', ['PENDING', 'PAID', 'REFUNDED', 'CANCELLED', 'FREE'])->default('PENDING');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
