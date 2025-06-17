<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_photo_path')->nullable();
            $table->string('selfie_photo_path')->nullable();
            $table->float('photo_similarity')->nullable();
            $table->enum('photo_verification_status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->text('photo_verification_notes')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile_photo_path');
            $table->dropColumn('selfie_photo_path');
            $table->dropColumn('photo_similarity');
            $table->dropColumn('photo_verification_status');
            $table->dropColumn('photo_verification_notes');
        });
    }
};
