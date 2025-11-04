<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ScrambleWord;

class ScrambleWordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $words = [
            // Set 1 - Basic Wellness
            ['word' => 'wellness', 'set' => 1, 'active' => true],
            ['word' => 'health', 'set' => 1, 'active' => true],
            ['word' => 'fitness', 'set' => 1, 'active' => true],
            ['word' => 'nutrition', 'set' => 1, 'active' => true],
            ['word' => 'exercise', 'set' => 1, 'active' => true],
            ['word' => 'meditation', 'set' => 1, 'active' => true],
            ['word' => 'mindfulness', 'set' => 1, 'active' => true],
            ['word' => 'balance', 'set' => 1, 'active' => true],

            // Set 2 - Mental Health
            ['word' => 'anxiety', 'set' => 2, 'active' => true],
            ['word' => 'stress', 'set' => 2, 'active' => true],
            ['word' => 'therapy', 'set' => 2, 'active' => true],
            ['word' => 'counseling', 'set' => 2, 'active' => true],
            ['word' => 'resilience', 'set' => 2, 'active' => true],
            ['word' => 'coping', 'set' => 2, 'active' => true],
            ['word' => 'mindset', 'set' => 2, 'active' => true],
            ['word' => 'positivity', 'set' => 2, 'active' => true],

            // Set 3 - Physical Health
            ['word' => 'cardio', 'set' => 3, 'active' => true],
            ['word' => 'strength', 'set' => 3, 'active' => true],
            ['word' => 'flexibility', 'set' => 3, 'active' => true],
            ['word' => 'endurance', 'set' => 3, 'active' => true],
            ['word' => 'stamina', 'set' => 3, 'active' => true],
            ['word' => 'muscle', 'set' => 3, 'active' => true],
            ['word' => 'workout', 'set' => 3, 'active' => true],
            ['word' => 'training', 'set' => 3, 'active' => true],

            // Set 4 - Nutrition
            ['word' => 'vitamins', 'set' => 4, 'active' => true],
            ['word' => 'minerals', 'set' => 4, 'active' => true],
            ['word' => 'protein', 'set' => 4, 'active' => true],
            ['word' => 'carbohydrates', 'set' => 4, 'active' => true],
            ['word' => 'hydration', 'set' => 4, 'active' => true],
            ['word' => 'metabolism', 'set' => 4, 'active' => true],
            ['word' => 'calories', 'set' => 4, 'active' => true],
            ['word' => 'nutrients', 'set' => 4, 'active' => true],

            // Set 5 - Lifestyle
            ['word' => 'sleep', 'set' => 5, 'active' => true],
            ['word' => 'routine', 'set' => 5, 'active' => true],
            ['word' => 'habits', 'set' => 5, 'active' => true],
            ['word' => 'discipline', 'set' => 5, 'active' => true],
            ['word' => 'motivation', 'set' => 5, 'active' => true],
            ['word' => 'goals', 'set' => 5, 'active' => true],
            ['word' => 'progress', 'set' => 5, 'active' => true],
            ['word' => 'achievement', 'set' => 5, 'active' => true],

            // Set 6 - Social Wellness
            ['word' => 'community', 'set' => 6, 'active' => true],
            ['word' => 'support', 'set' => 6, 'active' => true],
            ['word' => 'connection', 'set' => 6, 'active' => true],
            ['word' => 'relationships', 'set' => 6, 'active' => true],
            ['word' => 'communication', 'set' => 6, 'active' => true],
            ['word' => 'empathy', 'set' => 6, 'active' => true],
            ['word' => 'compassion', 'set' => 6, 'active' => true],
            ['word' => 'kindness', 'set' => 6, 'active' => true],

            // Set 7 - Professional Development
            ['word' => 'leadership', 'set' => 7, 'active' => true],
            ['word' => 'teamwork', 'set' => 7, 'active' => true],
            ['word' => 'collaboration', 'set' => 7, 'active' => true],
            ['word' => 'innovation', 'set' => 7, 'active' => true],
            ['word' => 'creativity', 'set' => 7, 'active' => true],
            ['word' => 'productivity', 'set' => 7, 'active' => true],
            ['word' => 'efficiency', 'set' => 7, 'active' => true],
            ['word' => 'excellence', 'set' => 7, 'active' => true],

            // Set 8 - Financial Wellness
            ['word' => 'budget', 'set' => 8, 'active' => true],
            ['word' => 'savings', 'set' => 8, 'active' => true],
            ['word' => 'investment', 'set' => 8, 'active' => true],
            ['word' => 'planning', 'set' => 8, 'active' => true],
            ['word' => 'security', 'set' => 8, 'active' => true],
            ['word' => 'freedom', 'set' => 8, 'active' => true],
            ['word' => 'stability', 'set' => 8, 'active' => true],
            ['word' => 'prosperity', 'set' => 8, 'active' => true],

            // Set 9 - Environmental Wellness
            ['word' => 'sustainability', 'set' => 9, 'active' => true],
            ['word' => 'conservation', 'set' => 9, 'active' => true],
            ['word' => 'environment', 'set' => 9, 'active' => true],
            ['word' => 'ecology', 'set' => 9, 'active' => true],
            ['word' => 'green', 'set' => 9, 'active' => true],
            ['word' => 'renewable', 'set' => 9, 'active' => true],
            ['word' => 'organic', 'set' => 9, 'active' => true],
            ['word' => 'natural', 'set' => 9, 'active' => true],

            // Set 10 - Spiritual Wellness
            ['word' => 'purpose', 'set' => 10, 'active' => true],
            ['word' => 'meaning', 'set' => 10, 'active' => true],
            ['word' => 'values', 'set' => 10, 'active' => true],
            ['word' => 'beliefs', 'set' => 10, 'active' => true],
            ['word' => 'faith', 'set' => 10, 'active' => true],
            ['word' => 'wisdom', 'set' => 10, 'active' => true],
            ['word' => 'enlightenment', 'set' => 10, 'active' => true],
            ['word' => 'transcendence', 'set' => 10, 'active' => true],
        ];

        foreach ($words as $wordData) {
            ScrambleWord::create($wordData);
        }
    }
}
