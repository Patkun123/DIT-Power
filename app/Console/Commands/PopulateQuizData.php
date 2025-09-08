<?php

namespace App\Console\Commands;

use App\Models\QuizAttempt;
use App\Models\User;
use Illuminate\Console\Command;
use Carbon\Carbon;

class PopulateQuizData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quiz:populate-data {--users=5} {--days=3}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate sample quiz data for testing leaderboards';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userCount = $this->option('users');
        $days = $this->option('days');
        
        $this->info("Populating quiz data for {$userCount} users over {$days} days...");
        
        // Get or create users
        $users = User::take($userCount)->get();
        
        if ($users->isEmpty()) {
            $this->error('No users found. Please create some users first.');
            return 1;
        }
        
        $sets = ['1', '2', '3'];
        $totalAttempts = 0;
        
        for ($day = 0; $day < $days; $day++) {
            $date = Carbon::now()->subDays($day);
            
            foreach ($users as $user) {
                // Create 1-3 attempts per user per day
                $attemptsPerDay = rand(1, 3);
                
                for ($i = 0; $i < $attemptsPerDay; $i++) {
                    $set = $sets[array_rand($sets)];
                    $score = rand(50, 200);
                    $correct = rand(5, 15);
                    
                    QuizAttempt::create([
                        'user_id' => $user->id,
                        'score' => $score,
                        'correct' => $correct,
                        'set' => $set,
                        'created_at' => $date->copy()->addHours(rand(9, 17)), // Random time during day
                        'updated_at' => $date->copy()->addHours(rand(9, 17)),
                    ]);
                    
                    $totalAttempts++;
                }
            }
        }
        
        $this->info("Successfully created {$totalAttempts} quiz attempts!");
        $this->info("Data spans from " . Carbon::now()->subDays($days - 1)->format('M j, Y') . " to " . Carbon::now()->format('M j, Y'));
        
        return 0;
    }
}
