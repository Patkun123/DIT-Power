<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'firstname' => 'Admin',
            'lastname' => 'Administrator',
            'email' => 'Admin@dti.gov.ph',
            'role' => "admin",
            'password' => Hash::make('admin123'),
        ]);
    }
}
