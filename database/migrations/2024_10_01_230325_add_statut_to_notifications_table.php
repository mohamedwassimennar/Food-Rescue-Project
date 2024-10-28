<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatutToNotificationsTable extends Migration
{
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            if (!Schema::hasColumn('notifications', 'statut')) {
                $table->string('statut')->after('date_heure'); // Only add the 'statut' column if it doesn't exist
            }
        });
    }

    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            if (Schema::hasColumn('notifications', 'statut')) {
                $table->dropColumn('statut'); // Remove the 'statut' column if it exists
            }
        });
    }
}
