<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Foreign keys for master data (dropdowns)
            $table->unsignedBigInteger('caste_id')->nullable();
            $table->unsignedBigInteger('religion_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('mother_tongue_id')->nullable();

            // Add foreign key constraints
$table->foreign('caste_id')->references('id')->on('castes')->onDelete('set null');
$table->foreign('religion_id')->references('id')->on('religions')->onDelete('set null');
$table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
$table->foreign('state_id')->references('id')->on('states')->onDelete('set null');
$table->foreign('mother_tongue_id')->references('id')->on('mother_tongues')->onDelete('set null');

            // Old string columns for data safety (optional to remove later)
            $table->string('religion')->nullable();
            $table->string('mother_tongue')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('caste')->nullable();

            $table->boolean('live_with_family')->nullable();
            $table->string('diet')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->text('about')->nullable();

            // Education & Career
            $table->string('highest_qualification')->nullable();
            $table->string('company_name')->nullable();
            $table->string('income_type')->nullable();
            $table->string('income')->nullable();
            $table->string('company_position')->nullable();

            // Family Details
            $table->string('family_type')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('father_occupation')->nullable();
            $table->integer('number_of_siblings')->nullable();

            // Lifestyle
            $table->string('drinking_habits')->nullable();
            $table->string('smoking_habits')->nullable();
            $table->boolean('open_to_pets')->nullable();
            $table->string('languages_spoken')->nullable();

            // Horoscope
            $table->string('birth_place')->nullable();
$table->date('birth_date')->nullable();
$table->string('birth_time')->nullable();
$table->string('zodiac_sign')->nullable();
$table->string('manglik_dosh')->nullable();


            // Likes
            $table->text('hobbies')->nullable();
            $table->text('favorite_music')->nullable();
            $table->text('favorite_books')->nullable();
            $table->text('favorite_movies')->nullable();
            $table->text('favorite_sports')->nullable();

            // Desired Partner
            $table->string('desired_age_min')->nullable();
            $table->string('desired_age_max')->nullable();
            $table->string('desired_relation_type')->nullable();
            $table->string('desired_religion')->nullable();
            $table->string('desired_mother_tongue')->nullable();
            $table->string('desired_diet')->nullable();
            $table->string('desired_state')->nullable();
            $table->string('desired_city')->nullable();
            $table->string('desired_highest_qualification')->nullable();
            $table->string('desired_income')->nullable();

            $table->timestamps();

            // Foreign key constraints (optional but recommended)
            $table->foreign('caste_id')->references('id')->on('castes')->nullOnDelete();
            $table->foreign('religion_id')->references('id')->on('religions')->nullOnDelete();
            $table->foreign('city_id')->references('id')->on('cities')->nullOnDelete();
            $table->foreign('state_id')->references('id')->on('states')->nullOnDelete();
            $table->foreign('mother_tongue_id')->references('id')->on('mother_tongues')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
