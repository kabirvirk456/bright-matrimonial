<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add only if not already exists
            if (!Schema::hasColumn('users', 'religion')) $table->string('religion')->nullable();
            if (!Schema::hasColumn('users', 'mother_tongue')) $table->string('mother_tongue')->nullable();
            if (!Schema::hasColumn('users', 'state')) $table->string('state')->nullable();
            if (!Schema::hasColumn('users', 'city')) $table->string('city')->nullable();
            if (!Schema::hasColumn('users', 'live_with_family')) $table->boolean('live_with_family')->nullable();
            if (!Schema::hasColumn('users', 'diet')) $table->string('diet')->nullable();
            if (!Schema::hasColumn('users', 'height')) $table->string('height')->nullable();
            if (!Schema::hasColumn('users', 'weight')) $table->string('weight')->nullable();
            if (!Schema::hasColumn('users', 'about')) $table->text('about')->nullable();
            if (!Schema::hasColumn('users', 'highest_qualification')) $table->string('highest_qualification')->nullable();
            if (!Schema::hasColumn('users', 'company_name')) $table->string('company_name')->nullable();
            if (!Schema::hasColumn('users', 'income_type')) $table->string('income_type')->nullable();
            if (!Schema::hasColumn('users', 'income')) $table->string('income')->nullable();
            if (!Schema::hasColumn('users', 'company_position')) $table->string('company_position')->nullable();
            if (!Schema::hasColumn('users', 'caste')) $table->string('caste')->nullable();
            if (!Schema::hasColumn('users', 'family_type')) $table->string('family_type')->nullable();
            if (!Schema::hasColumn('users', 'mother_occupation')) $table->string('mother_occupation')->nullable();
            if (!Schema::hasColumn('users', 'father_occupation')) $table->string('father_occupation')->nullable();
            if (!Schema::hasColumn('users', 'siblings')) $table->integer('siblings')->nullable();
            if (!Schema::hasColumn('users', 'drinking_habits')) $table->string('drinking_habits')->nullable();
            if (!Schema::hasColumn('users', 'smoking_habits')) $table->string('smoking_habits')->nullable();
            if (!Schema::hasColumn('users', 'open_to_pets')) $table->boolean('open_to_pets')->nullable();
            if (!Schema::hasColumn('users', 'languages_spoken')) $table->string('languages_spoken')->nullable();
            if (!Schema::hasColumn('users', 'birth_place')) $table->string('birth_place')->nullable();
            if (!Schema::hasColumn('users', 'birth_date')) $table->date('birth_date')->nullable();
            if (!Schema::hasColumn('users', 'birth_time')) $table->string('birth_time')->nullable();
            if (!Schema::hasColumn('users', 'zodiac_sign')) $table->string('zodiac_sign')->nullable();
            if (!Schema::hasColumn('users', 'horoscope_match')) $table->string('horoscope_match')->nullable();
            if (!Schema::hasColumn('users', 'manglik_dosh')) $table->string('manglik_dosh')->nullable();
            if (!Schema::hasColumn('users', 'hobbies')) $table->text('hobbies')->nullable();
            if (!Schema::hasColumn('users', 'favorite_music')) $table->text('favorite_music')->nullable();
            if (!Schema::hasColumn('users', 'favorite_books')) $table->text('favorite_books')->nullable();
            if (!Schema::hasColumn('users', 'favorite_movies')) $table->text('favorite_movies')->nullable();
            if (!Schema::hasColumn('users', 'favorite_sports')) $table->text('favorite_sports')->nullable();
            if (!Schema::hasColumn('users', 'desired_age_min')) $table->string('desired_age_min')->nullable();
            if (!Schema::hasColumn('users', 'desired_age_max')) $table->string('desired_age_max')->nullable();
            if (!Schema::hasColumn('users', 'desired_relation_type')) $table->string('desired_relation_type')->nullable();
            if (!Schema::hasColumn('users', 'desired_religion')) $table->string('desired_religion')->nullable();
            if (!Schema::hasColumn('users', 'desired_mother_tongue')) $table->string('desired_mother_tongue')->nullable();
            if (!Schema::hasColumn('users', 'desired_diet')) $table->string('desired_diet')->nullable();
            if (!Schema::hasColumn('users', 'desired_state')) $table->string('desired_state')->nullable();
            if (!Schema::hasColumn('users', 'desired_city')) $table->string('desired_city')->nullable();
            if (!Schema::hasColumn('users', 'desired_highest_qualification')) $table->string('desired_highest_qualification')->nullable();
            if (!Schema::hasColumn('users', 'desired_income')) $table->string('desired_income')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = [
                'religion', 'mother_tongue', 'state', 'city', 'live_with_family', 'diet',
                'height', 'weight', 'about', 'highest_qualification', 'company_name', 'income_type',
                'income', 'company_position', 'caste', 'family_type', 'mother_occupation', 'father_occupation',
                'siblings', 'drinking_habits', 'smoking_habits', 'open_to_pets', 'languages_spoken',
                'birth_place', 'birth_date', 'birth_time', 'zodiac_sign', 'horoscope_match', 'manglik_dosh',
                'hobbies', 'favorite_music', 'favorite_books', 'favorite_movies', 'favorite_sports',
                'desired_age_min', 'desired_age_max', 'desired_relation_type', 'desired_religion',
                'desired_mother_tongue', 'desired_diet', 'desired_state', 'desired_city',
                'desired_highest_qualification', 'desired_income'
            ];
            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
