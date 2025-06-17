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
        Schema::table('favorite_music', function (Blueprint $table) {
            // Only add the column if it doesn't already exist
            if (!Schema::hasColumn('favorite_music', 'name')) {
                $table->string('name')->unique()->after('id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('favorite_music', function (Blueprint $table) {
            if (Schema::hasColumn('favorite_music', 'name')) {
                $table->dropColumn('name');
            }
        });
    }
};
