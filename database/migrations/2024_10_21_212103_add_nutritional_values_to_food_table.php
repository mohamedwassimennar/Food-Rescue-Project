<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('food', function (Blueprint $table) {
            $table->decimal('calories', 8, 2)->after('expired_date');
            $table->decimal('fats', 8, 2)->after('calories');
            $table->decimal('carbs', 8, 2)->after('fats');
            $table->decimal('proteins', 8, 2)->after('carbs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('food', function (Blueprint $table) {
            $table->dropColumn(['calories', 'fats', 'carbs', 'proteins']);
        });
    }
};
