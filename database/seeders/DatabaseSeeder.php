<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a test user
        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
            
        ]);

        // Seed 20 dummy profiles (and their own users)
        Profile::factory()
            ->count(20)
            ->create();
            
            $this->call(TestProfileSeeder::class);

    }
}
