<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('profiles', 'hobby_id')) {
                $table->unsignedBigInteger('hobby_id')->nullable()->after('weight');
            }
            if (!Schema::hasColumn('profiles', 'profession_id')) {
                $table->unsignedBigInteger('profession_id')->nullable()->after('hobby_id');
            }
        });
    }

    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            if (Schema::hasColumn('profiles', 'hobby_id')) {
                $table->dropColumn('hobby_id');
            }
            if (Schema::hasColumn('profiles', 'profession_id')) {
                $table->dropColumn('profession_id');
            }
        });
    }
};
