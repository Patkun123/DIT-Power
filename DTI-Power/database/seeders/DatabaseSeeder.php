<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'firstname' => 'Admin',
            'lastname' => 'Administrator',
            'email' => 'Admin@dti.gov.ph',
            'role' => "admin",
            'password' => Hash::make('admin123'),
        ]);

        User::factory()->create([
            'firstname' => '',
            'lastname' => '',
            'email' => 'Patrickfabular48@dti.gov.ph',
            'role' => "user",
            'password' => Hash::make('dti123456'),
        ]);

        $this->call([
            QuizSeeder::class
        ]);
    }
}
