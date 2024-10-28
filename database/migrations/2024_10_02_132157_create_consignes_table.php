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
        Schema::create('consignes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('association_id')->constrained()->onDelete('cascade'); 
            $table->string('expediteur');
            $table->string('destinataire');
            $table->text('contenu');
            $table->timestamp('date_envoi')->useCurrent();  
            $table->enum('statut', ['Envoyé', 'Reçu']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consignes');
    }
};
