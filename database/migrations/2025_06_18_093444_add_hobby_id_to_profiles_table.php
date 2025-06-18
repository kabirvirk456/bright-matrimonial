<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('profiles', function (Blueprint $table) {
        $table->unsignedBigInteger('hobby_id')->nullable()->after('weight');
    });
}
public function down()
{
    Schema::table('profiles', function (Blueprint $table) {
        $table->dropColumn('hobby_id');
    });
}

};
