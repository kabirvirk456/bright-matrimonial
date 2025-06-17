<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            // Only add columns if they do NOT already exist
            if (!Schema::hasColumn('profiles', 'religion')) {
                $table->string('religion')->nullable();
            }
            if (!Schema::hasColumn('profiles', 'caste')) {
                $table->string('caste')->nullable();
            }
            if (!Schema::hasColumn('profiles', 'state')) {
                $table->string('state')->nullable();
            }
            // Do NOT add marital_status again
        });
    }

    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            // Only drop columns that are safe to drop
            if (Schema::hasColumn('profiles', 'religion')) {
                $table->dropColumn('religion');
            }
            if (Schema::hasColumn('profiles', 'caste')) {
                $table->dropColumn('caste');
            }
            if (Schema::hasColumn('profiles', 'state')) {
                $table->dropColumn('state');
            }
            // Do NOT drop marital_status here either
        });
    }
};
