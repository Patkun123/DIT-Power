<?php

namespace App\Console\Commands;

use App\Models\Feedbacks;
use Illuminate\Console\Command;

class PopulateFeedbackData extends Command
{
    protected $signature = 'feedback:populate {--count=10}';
    protected $description = 'Populate sample feedback data for testing';

    public function handle()
    {
        $count = $this->option('count');
        $this->info("Creating {$count} sample feedback entries...");

        $sampleEmails = [
            'john.doe@example.com',
            'jane.smith@example.com',
            'mike.johnson@example.com',
            'sarah.wilson@example.com',
            'david.brown@example.com',
            'lisa.garcia@example.com',
            'robert.miller@example.com',
            'emily.davis@example.com',
            'james.rodriguez@example.com',
            'amanda.martinez@example.com',
        ];

        $sampleMessages = [
            'Great platform! Very user-friendly and helpful.',
            'The quiz system is excellent. Learned a lot!',
            'Could use some improvements in the mobile interface.',
            'Love the wellness tracking features. Keep it up!',
            'The nutrition section needs more variety.',
            'Overall satisfied with the service.',
            'The journal feature is my favorite part.',
            'Some bugs in the quiz scoring system.',
            'Excellent customer support and quick responses.',
            'The platform has helped me improve my health significantly.',
            'Would like to see more interactive features.',
            'The design is clean and modern.',
            'Some features are hard to find.',
            'Great value for money!',
            'The notifications are very helpful.',
        ];

        for ($i = 0; $i < $count; $i++) {
            Feedbacks::create([
                'email' => $sampleEmails[array_rand($sampleEmails)],
                'rating' => rand(1, 5),
                'message' => $sampleMessages[array_rand($sampleMessages)],
                'created_at' => now()->subDays(rand(0, 30)),
            ]);
        }

        $this->info("Successfully created {$count} sample feedback entries!");
        $this->info("You can now view them in the admin panel at /feedbacks");
        
        return 0;
    }
}

