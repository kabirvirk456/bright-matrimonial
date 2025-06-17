<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            // Add 'siblings' column after 'father_occupation'. Adjust the position if needed.
            if (!Schema::hasColumn('profiles', 'siblings')) {
                $table->integer('siblings')->nullable()->after('father_occupation');
            }
        });
    }

    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            // Drop 'siblings' column only if it exists
            if (Schema::hasColumn('profiles', 'siblings')) {
                $table->dropColumn('siblings');
            }
        });
    }
};
