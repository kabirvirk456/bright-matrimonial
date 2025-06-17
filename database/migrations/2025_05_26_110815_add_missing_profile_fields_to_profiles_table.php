<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingProfileFieldsToProfilesTable extends Migration
{
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            // Only add columns that don't exist yet
            if (!Schema::hasColumn('profiles', 'about')) {
                $table->text('about')->nullable();
            }
            if (!Schema::hasColumn('profiles', 'marital_status')) {
                
            }
            if (!Schema::hasColumn('profiles', 'highest_qualification')) {
                $table->string('highest_qualification')->nullable();
            }
            if (!Schema::hasColumn('profiles', 'company_position')) {
                $table->string('company_position')->nullable();
            }
            if (!Schema::hasColumn('profiles', 'height')) {
                $table->decimal('height', 5, 2)->nullable();
            }
            if (!Schema::hasColumn('profiles', 'weight')) {
                $table->decimal('weight', 5, 2)->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            // Drop columns safely if they exist
            if (Schema::hasColumn('profiles', 'about')) {
                $table->dropColumn('about');
            }
            if (Schema::hasColumn('profiles', 'marital_status')) {
                $table->dropColumn('marital_status');
            }
            if (Schema::hasColumn('profiles', 'highest_qualification')) {
                $table->dropColumn('highest_qualification');
            }
            if (Schema::hasColumn('profiles', 'company_position')) {
                $table->dropColumn('company_position');
            }
            if (Schema::hasColumn('profiles', 'height')) {
                $table->dropColumn('height');
            }
            if (Schema::hasColumn('profiles', 'weight')) {
                $table->dropColumn('weight');
            }
        });
    }
}
