<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // Type de notification
            $table->dateTime('date_heure'); // Date et heure de la notification
            $table->string('statut'); // Statut de la notification
            $table->string('message'); // Message de la notification
            $table->foreignId('evenement_collecte_id')->constrained()->onDelete('cascade'); // Clé étrangère
            $table->timestamps(); // Timestamps
        });        
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
