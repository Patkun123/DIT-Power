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
        $now = Carbon::now('Asia/Manila');
        
        // Quiz time slots
        $quizSlots = [
            ['set' => 1, 'start' => $now->copy()->setTime(9, 30), 'end' => $now->copy()->setTime(10, 30)],
            ['set' => 2, 'start' => $now->copy()->setTime(12, 0), 'end' => $now->copy()->setTime(13, 0)],
            ['set' => 3, 'start' => $now->copy()->setTime(15, 0), 'end' => $now->copy()->setTime(16, 0)],
        ];

        $notificationsSent = 0;

        foreach ($quizSlots as $slot) {
            // Check if we're within 5 minutes of quiz start (reminder)
            if ($now->between($slot['start']->copy()->subMinutes(5), $slot['start']->copy()->subMinute())) {
                $count = $this->quizNotificationService->sendQuizReminderNotification($slot['set'], 5);
                $notificationsSent += $count;
                $this->info("Sent reminder notifications for Set {$slot['set']} to {$count} users.");
            }
            
            // Check if quiz has just started (within first minute)
            if ($now->between($slot['start'], $slot['start']->copy()->addMinute())) {
                $count = $this->quizNotificationService->sendQuizStartNotification($slot['set'], $slot['start']);
                $notificationsSent += $count;
                $this->info("Sent start notifications for Set {$slot['set']} to {$count} users.");
            }

            // Check if we're within 5 minutes of quiz end (end notification)
            if ($now->between($slot['end']->copy()->subMinutes(5), $slot['end'])) {
                $count = $this->quizNotificationService->sendQuizEndNotification($slot['set'], 5);
                $notificationsSent += $count;
                $this->info("Sent end notifications for Set {$slot['set']} to {$count} users.");
            }
        }

        if ($notificationsSent === 0) {
            $this->info("No notifications needed at this time.");
        } else {
            $this->info("Total notifications sent: {$notificationsSent}");
        }

        return 0;
    }
}
