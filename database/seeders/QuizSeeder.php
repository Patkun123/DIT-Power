<?php

namespace Database\Seeders;

use App\Models\QuizQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        QuizQuestion::factory(50)->create()->each(function ($question) {
            foreach(["A", "B", "C", "D"] as $letter) {
                $question->choices()->create([
                    'letter' => $letter,
                    'content' => fake()->sentence(),
                ]);
            }
        });
    }
}
