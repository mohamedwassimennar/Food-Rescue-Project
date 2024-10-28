<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateHeureToNotificationsTable extends Migration
{
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            if (!Schema::hasColumn('notifications', 'date_heure')) {
                $table->dateTime('date_heure')->after('type'); // Only add if it doesn't exist
            }
        });
    }

    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            if (Schema::hasColumn('notifications', 'date_heure')) {
                $table->dropColumn('date_heure'); // Remove if it exists
            }
        });
    }
}
