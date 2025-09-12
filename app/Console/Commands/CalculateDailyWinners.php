<?php

namespace App\Console\Commands;

use App\Services\DailyWinnerService;
use Illuminate\Console\Command;
use Carbon\Carbon;

class CalculateDailyWinners extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'winners:calculate {--date= : Specific date to calculate winners for (Y-m-d format)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate and store daily winners for overall and set-specific leaderboards';

    protected $dailyWinnerService;

    public function __construct(DailyWinnerService $dailyWinnerService)
    {
        parent::__construct();
        $this->dailyWinnerService = $dailyWinnerService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = $this->option('date');
        
        if ($date) {
            try {
                $date = Carbon::parse($date);
            } catch (\Exception $e) {
                $this->error('Invalid date format. Please use Y-m-d format (e.g., 2024-01-15)');
                return 1;
            }
        } else {
            $date = Carbon::yesterday();
        }
        
        $this->info("Calculating daily winners for {$date->format('Y-m-d')}...");
        
        try {
            $winners = $this->dailyWinnerService->calculateDailyWinners($date);
            
            $this->info('Daily winners calculated successfully!');
            
            // Display results
            $this->displayResults($winners, $date);
            
            return 0;
            
        } catch (\Exception $e) {
            $this->error('Error calculating daily winners: ' . $e->getMessage());
            return 1;
        }
    }
    
    /**
     * Display the calculated winners
     */
    private function displayResults(array $winners, Carbon $date): void
    {
        $this->line('');
        $this->info("=== Daily Winners for {$date->format('M d, Y')} ===");
        $this->line('');
        
        // Overall winner
        if (isset($winners['overall'])) {
            $winner = $winners['overall'];
            $this->line("🏆 Overall Champion: {$winner->user->firstname} {$winner->user->lastname}");
            $this->line("   Score: {$winner->score} points | Correct: {$winner->correct_answers} | Attempts: {$winner->attempts_count}");
            $this->line('');
        }
        
        // Set winners
        for ($set = 1; $set <= 3; $set++) {
            $key = "set_{$set}";
            if (isset($winners[$key])) {
                $winner = $winners[$key];
                $this->line("🥇 Set {$set} Winner: {$winner->user->firstname} {$winner->user->lastname}");
                $this->line("   Score: {$winner->score} points | Correct: {$winner->correct_answers} | Attempts: {$winner->attempts_count}");
                $this->line('');
            } else {
                $this->line("❌ Set {$set}: No attempts recorded");
                $this->line('');
            }
        }
    }
}
