<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizChoice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample quizzes
        $quiz1 = Quiz::create([
            'quiz_title' => 'Health & Wellness Quiz',
            'description' => 'Test your knowledge about health and wellness topics',
            'start_date' => Carbon::now()->subHours(2), // Started 2 hours ago
            'end_date' => Carbon::now()->addDays(7), // Ends in 7 days
        ]);

        $quiz2 = Quiz::create([
            'quiz_title' => 'Nutrition Basics Quiz',
            'description' => 'Learn about proper nutrition and healthy eating habits',
            'start_date' => Carbon::now()->addDays(1), // Starts tomorrow
            'end_date' => Carbon::now()->addDays(8), // Ends in 8 days
        ]);

        $quiz3 = Quiz::create([
            'quiz_title' => 'Mental Health Awareness Quiz',
            'description' => 'Understanding mental health and wellness strategies',
            'start_date' => Carbon::now()->addDays(3), // Starts in 3 days
            'end_date' => Carbon::now()->addDays(10), // Ends in 10 days
        ]);

        // Create questions for Quiz 1 (Health & Wellness)
        $questions1 = [
            [
                'content' => 'What is the recommended daily water intake for adults?',
                'answer' => 'A',
                'choices' => [
                    'A' => '8 glasses (2 liters)',
                    'B' => '4 glasses (1 liter)',
                    'C' => '12 glasses (3 liters)',
                    'D' => '6 glasses (1.5 liters)'
                ]
            ],
            [
                'content' => 'Which vitamin is essential for bone health?',
                'answer' => 'C',
                'choices' => [
                    'A' => 'Vitamin A',
                    'B' => 'Vitamin B12',
                    'C' => 'Vitamin D',
                    'D' => 'Vitamin C'
                ]
            ],
            [
                'content' => 'How many hours of sleep should adults get per night?',
                'answer' => 'B',
                'choices' => [
                    'A' => '6-7 hours',
                    'B' => '7-9 hours',
                    'C' => '9-10 hours',
                    'D' => '5-6 hours'
                ]
            ],
            [
                'content' => 'What is the primary benefit of regular exercise?',
                'answer' => 'D',
                'choices' => [
                    'A' => 'Only weight loss',
                    'B' => 'Only muscle building',
                    'C' => 'Only cardiovascular health',
                    'D' => 'Overall physical and mental health'
                ]
            ],
            [
                'content' => 'Which of the following is a sign of good mental health?',
                'answer' => 'A',
                'choices' => [
                    'A' => 'Ability to cope with stress',
                    'B' => 'Never feeling sad',
                    'C' => 'Always being happy',
                    'D' => 'Avoiding all challenges'
                ]
            ]
        ];

        foreach ($questions1 as $q) {
            $question = QuizQuestion::create([
                'quiz_id' => $quiz1->id,
                'content' => $q['content'],
                'answer' => $q['answer'],
                'set' => '1',
            ]);

            foreach ($q['choices'] as $letter => $content) {
                QuizChoice::create([
                    'question_id' => $question->id,
                    'letter' => $letter,
                    'content' => $content,
                ]);
            }
        }

        // Create questions for Quiz 2 (Nutrition Basics)
        $questions2 = [
            [
                'content' => 'Which macronutrient provides the most energy per gram?',
                'answer' => 'B',
                'choices' => [
                    'A' => 'Protein',
                    'B' => 'Fat',
                    'C' => 'Carbohydrates',
                    'D' => 'Fiber'
                ]
            ],
            [
                'content' => 'What is the main function of carbohydrates in the body?',
                'answer' => 'C',
                'choices' => [
                    'A' => 'Building muscle',
                    'B' => 'Storing fat',
                    'C' => 'Providing energy',
                    'D' => 'Regulating temperature'
                ]
            ],
            [
                'content' => 'Which vitamin is found in citrus fruits?',
                'answer' => 'A',
                'choices' => [
                    'A' => 'Vitamin C',
                    'B' => 'Vitamin D',
                    'C' => 'Vitamin B12',
                    'D' => 'Vitamin K'
                ]
            ]
        ];

        foreach ($questions2 as $q) {
            $question = QuizQuestion::create([
                'quiz_id' => $quiz2->id,
                'content' => $q['content'],
                'answer' => $q['answer'],
                'set' => '1',
            ]);

            foreach ($q['choices'] as $letter => $content) {
                QuizChoice::create([
                    'question_id' => $question->id,
                    'letter' => $letter,
                    'content' => $content,
                ]);
            }
        }

        // Create questions for Quiz 3 (Mental Health)
        $questions3 = [
            [
                'content' => 'What is mindfulness?',
                'answer' => 'D',
                'choices' => [
                    'A' => 'A type of medication',
                    'B' => 'A form of exercise',
                    'C' => 'A diet plan',
                    'D' => 'Being present in the moment'
                ]
            ],
            [
                'content' => 'Which activity can help reduce stress?',
                'answer' => 'A',
                'choices' => [
                    'A' => 'Deep breathing exercises',
                    'B' => 'Avoiding all problems',
                    'C' => 'Working longer hours',
                    'D' => 'Isolating yourself'
                ]
            ]
        ];

        foreach ($questions3 as $q) {
            $question = QuizQuestion::create([
                'quiz_id' => $quiz3->id,
                'content' => $q['content'],
                'answer' => $q['answer'],
                'set' => '1',
            ]);

            foreach ($q['choices'] as $letter => $content) {
                QuizChoice::create([
                    'question_id' => $question->id,
                    'letter' => $letter,
                    'content' => $content,
                ]);
            }
        }
    }
}
