<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\QuizSet;
use Carbon\Carbon;

class ActivateQuizSetsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quiz-sets:activate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically update quiz set statuses based on start and end times';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🕐 Checking quiz sets for status updates...');
        $this->info('Current time: ' . Carbon::now()->format('Y-m-d H:i:s'));

        $sets = QuizSet::getSetsNeedingStatusUpdate();

        if ($sets->isEmpty()) {
            $this->info('✅ No quiz sets need status updates.');
            return 0;
        }

        $this->info("📋 Found {$sets->count()} set(s) needing updates:");
        $activated = 0;
        $ended = 0;

        foreach ($sets as $set) {
            $old = $set->status;
            $updated = $set->updateStatusAutomatically();
            if ($updated) {
                $this->line(" - Set #{$set->set_number} ({$set->set_name}) for quiz ID {$set->quiz_id}: {$old} -> {$set->status}");
                if ($set->status === 'active') { $activated++; }
                if ($set->status === 'ended') { $ended++; }
            }
        }

        $this->info("✅ Updates complete. Activated: {$activated}, Ended: {$ended}");
        return 0;
    }
}



