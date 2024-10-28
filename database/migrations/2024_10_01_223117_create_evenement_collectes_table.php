<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvenementCollectesTable extends Migration
{
    public function up()
    {
        Schema::create('evenement_collectes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->date('date');
            $table->string('lieu');
            $table->string('type_nourriture');
            $table->string('organisateur');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('evenement_collectes');
    }
}
