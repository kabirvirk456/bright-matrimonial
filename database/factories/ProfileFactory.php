<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Profile;
use App\Models\User;

class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    public function definition()
    {
        $castes = ['Aggarwal', 'Kanyakubj', 'Brahmin', 'Gaur Brahmin', 'Brahmin Jat', 'Kayastha', 'Khatri'];
        $religions = ['Hindu', 'Muslim', 'Sikh', 'Christian'];
        $cities = ['Mumbai', 'Delhi', 'Bangalore', 'Hyderabad'];
        $occupations = ['Doctor', 'Engineer', 'Business', 'Teacher'];
        $genders = ['male', 'female'];

        // Make a fake user and get ID
        $user = User::factory()->create([
            'name' => $this->faker->name,
            'email' =>  $this->faker->unique()->safeEmail,
            // Add other required user fields if needed
        ]);

        return [
            'user_id'    => $user->id,
            'name'       => $user->name,
            'gender'     => $this->faker->randomElement($genders),
            'dob'        => $this->faker->dateTimeBetween('-40 years', '-21 years')->format('Y-m-d'),
            'age'        => $this->faker->numberBetween(21, 40),
            'caste'      => $this->faker->randomElement($castes),
            'religion'   => $this->faker->randomElement($religions),
            'city'       => $this->faker->randomElement($cities),
            'occupation' => $this->faker->randomElement($occupations),
            'bio'        => $this->faker->paragraph(2),
            'photo_path' => null, // Or use $this->faker->imageUrl(200,200) for testing images
            // Add other existing fields here as needed (leave others as is)
        ];
    }
}
