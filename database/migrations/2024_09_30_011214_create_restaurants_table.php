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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('contact')->nullable();
            $table->string('cuisine_type')->nullable();
            $table->integer('total_food')->default(0);
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();
            $table->text('donation_history')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('status')->default('PENDING');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
