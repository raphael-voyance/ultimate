<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('sender_id')->nullable();
            $table->foreign('sender_id')->references('id')->on('users');
            $table->string('sender_email');
            $table->string('sender_first_name');
            $table->string('sender_last_name');

            $table->unsignedBigInteger('receiver_id')->nullable();
            $table->foreign('receiver_id')->references('id')->on('users');
            $table->string('receiver_email');
            $table->string('receiver_first_name');
            $table->string('receiver_last_name');

            $table->text('content');
            $table->text('subject')->nullable();
            $table->string('sender_phone')->nullable();

            $table->unsignedBigInteger('reply_to')->nullable();
            $table->foreign('reply_to')->references('id')->on('messages');

            $table->boolean('read')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
