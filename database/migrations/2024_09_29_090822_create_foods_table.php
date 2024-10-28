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
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->enum('topic', ['Kesehatan', 'Kecantikan', 'Lifesttyle']);
            $table->string('image'); 
            $table->time('jam_buat');
            $table->string('penulis');
            $table->date('hari_buat');
            $table->text('isi');    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};