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
        Schema::create('demandes', function (Blueprint $table) {
                        $table->id(); // Ajout d'un identifiant unique

           $table->unsignedBigInteger('association_id'); // Clé étrangère pour l'association
            $table->string('produit'); // Produit demandé
            $table->integer('quantite'); // Quantité du produit
            $table->date('date_collecte'); // Date de collecte prévue
            $table->enum('etat', ['Onhold', 'Accepted', 'Refused'])->default('Onhold'); // État de la demande
            $table->timestamps(); // Colonnes created_at et updated_at

            // Clés étrangères
            $table->foreign('association_id')->references('id')->on('associations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};
