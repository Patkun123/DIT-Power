<?php

namespace App\Console\Commands;

use App\Services\QuizNotificationService;
use Illuminate\Console\Command;
use Carbon\Carbon;

class ScheduleQuizNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quiz:auto-notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically send quiz notifications based on schedule';

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
        $this->info("Starting quiz notification scheduling...");
        
        // Use the new dynamic quiz notification system
        $notificationsSent = $this->quizNotificationService->scheduleQuizNotifications();
        
        if ($notificationsSent === 0) {
            $this->info("No notifications needed at this time.");
        } else {
            $this->info("Total notifications sent: {$notificationsSent}");
        }

        return 0;
    }
}
