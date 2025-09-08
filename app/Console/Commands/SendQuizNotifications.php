<?php

namespace App\Console\Commands;

use App\Services\QuizNotificationService;
use Illuminate\Console\Command;

class SendQuizNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quiz:send-notifications {--set=} {--type=start} {--minutes=5}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send quiz notifications to all users';

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
        $set = $this->option('set');
        $type = $this->option('type');
        $minutes = $this->option('minutes');

        if ($set) {
            // Send notification for specific set
            if ($type === 'start') {
                $count = $this->quizNotificationService->sendQuizStartNotification($set);
                $this->info("Sent quiz start notification for Set {$set} to {$count} users.");
            } elseif ($type === 'reminder') {
                $count = $this->quizNotificationService->sendQuizReminderNotification($set, $minutes);
                $this->info("Sent quiz reminder notification for Set {$set} to {$count} users.");
            } elseif ($type === 'end') {
                $count = $this->quizNotificationService->sendQuizEndNotification($set, $minutes);
                $this->info("Sent quiz end notification for Set {$set} to {$count} users.");
            } else {
                $this->error("Invalid type. Use 'start', 'reminder', or 'end'.");
                return 1;
            }
        } else {
            // Schedule all notifications based on current time
            $this->quizNotificationService->scheduleQuizNotifications();
            $this->info("Scheduled quiz notifications based on current time.");
        }

        return 0;
    }
}
