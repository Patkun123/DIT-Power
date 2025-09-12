<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Quiz;
use Carbon\Carbon;
use App\Services\ActivityService;
use App\Services\QuizNotificationService;

class ActivateQuizzesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quiz:activate {--force : Force activation even if already active}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically activate quizzes when their start time matches current Philippines time';

    protected $quizNotificationService;

    public function __construct(QuizNotificationService $quizNotificationService)
    {
        parent::__construct();
        $this->quizNotificationService = $quizNotificationService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🕐 Checking for quizzes to activate...');
        $this->info('Current time: ' . Carbon::now()->format('Y-m-d H:i:s'));
        
        // Get all quizzes that need status updates
        $quizzesNeedingUpdate = Quiz::getQuizzesNeedingStatusUpdate();

        if ($quizzesNeedingUpdate->isEmpty()) {
            $this->info('✅ No quizzes need status updates at this time.');
            return 0;
        }

        $this->info("📋 Found {$quizzesNeedingUpdate->count()} quiz(es) needing status updates:");

        $activatedCount = 0;
        $endedCount = 0;
        
        foreach ($quizzesNeedingUpdate as $quiz) {
            $oldStatus = $quiz->status;
            $wasUpdated = $quiz->updateStatusAutomatically();
            
            if ($wasUpdated) {
                if ($quiz->status === 'active') {
                    $this->line("  ✅ {$quiz->quiz_title} (ID: {$quiz->id}) - Status changed from '{$oldStatus}' to 'active'");
                    $this->line("    Start: {$quiz->start_date->setTimezone('Asia/Manila')->format('Y-m-d H:i:s')} (Philippines)");
                    $this->line("    End: {$quiz->end_date->setTimezone('Asia/Manila')->format('Y-m-d H:i:s')} (Philippines)");
                    
                    // Log the activation
                    ActivityService::logQuizActivated(
                        'system', // System user
                        $quiz->quiz_title,
                        $currentTime->format('Y-m-d H:i:s')
                    );
                    
                    // Send notification to users
                    $notificationCount = $this->quizNotificationService->sendQuizActivatedNotification($quiz);
                    $this->line("    📢 Sent activation notifications to {$notificationCount} users");
                    
                    $activatedCount++;
                } elseif ($quiz->status === 'ended') {
                    $this->line("  🔚 {$quiz->quiz_title} (ID: {$quiz->id}) - Status changed from '{$oldStatus}' to 'ended'");
                    $this->line("    Ended at: {$quiz->end_date->setTimezone('Asia/Manila')->format('Y-m-d H:i:s')} (Philippines)");
                    
                    // Send notification to users who attempted the quiz
                    $notificationCount = $this->quizNotificationService->sendQuizEndedNotification($quiz);
                    $this->line("    📢 Sent end notifications to {$notificationCount} users");
                    
                    $endedCount++;
                }
            } else {
                $this->line("  ⚠️  {$quiz->quiz_title} (ID: {$quiz->id}) - No status change needed (current: {$quiz->status})");
            }
        }

        if ($activatedCount > 0) {
            $this->info("✅ Successfully activated {$activatedCount} quiz(es)!");
        }
        
        if ($endedCount > 0) {
            $this->info("🔚 Successfully ended {$endedCount} quiz(es)!");
        }

        return 0;
    }
}
