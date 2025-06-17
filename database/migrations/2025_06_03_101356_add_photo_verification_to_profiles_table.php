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
        // Add columns to 'profiles' table
        Schema::table('profiles', function (Blueprint $table) {
            $table->boolean('photo_verified')->default(false);
            $table->float('photo_similarity')->nullable();
            $table->timestamp('photo_verified_at')->nullable();
        });

        // Add columns to 'users' table
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_photo_path')->nullable();
            $table->string('selfie_photo_path')->nullable();
            $table->enum('photo_verification_status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->text('photo_verification_notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Remove columns from 'profiles' table
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('photo_verified');
            $table->dropColumn('photo_similarity');
            $table->dropColumn('photo_verified_at');
        });

        // Remove columns from 'users' table
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile_photo_path');
            $table->dropColumn('selfie_photo_path');
            $table->dropColumn('photo_verification_status');
            $table->dropColumn('photo_verification_notes');
        });
    }
};
