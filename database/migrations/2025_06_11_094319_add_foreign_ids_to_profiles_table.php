<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->unsignedBigInteger('caste_id')->nullable()->after('user_id');
            $table->unsignedBigInteger('religion_id')->nullable()->after('caste_id');
            $table->unsignedBigInteger('city_id')->nullable()->after('religion_id');
            $table->unsignedBigInteger('state_id')->nullable()->after('city_id');
            $table->unsignedBigInteger('mother_tongue_id')->nullable()->after('state_id');
        });
    }

    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('caste_id');
            $table->dropColumn('religion_id');
            $table->dropColumn('city_id');
            $table->dropColumn('state_id');
            $table->dropColumn('mother_tongue_id');
        });
    }
};
