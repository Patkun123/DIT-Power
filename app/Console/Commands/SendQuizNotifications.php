<?php

namespace App\Console\Commands;

use App\Services\QuizNotificationService;
use Illuminate\Console\Command;
use Carbon\Carbon;

class SendQuizNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quiz:notify {--type=all : Type of notification to send (all, reminder, activated, ending, ended)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send quiz notifications based on current time and quiz schedules';

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
        $type = $this->option('type');
        $this->info("Sending quiz notifications (type: {$type})...");
        
        $notificationsSent = 0;

        switch ($type) {
            case 'all':
                $notificationsSent = $this->quizNotificationService->scheduleQuizNotifications();
                break;
            case 'reminder':
                $notificationsSent = $this->sendReminderNotifications();
                break;
            case 'activated':
                $notificationsSent = $this->sendActivationNotifications();
                break;
            case 'ending':
                $notificationsSent = $this->sendEndingNotifications();
                break;
            case 'ended':
                $notificationsSent = $this->sendEndedNotifications();
                break;
            default:
                $this->error("Invalid notification type: {$type}");
                return 1;
        }

        if ($notificationsSent === 0) {
            $this->info("No notifications sent.");
        } else {
            $this->info("Total notifications sent: {$notificationsSent}");
        }

        return 0;
    }

    private function sendReminderNotifications()
    {
        $now = Carbon::now('Asia/Manila');
        $notificationsSent = 0;

        $quizzes = \App\Models\Quiz::where('status', 'scheduled')
            ->where('start_date', '>', $now->copy()->subMinutes(10))
            ->where('start_date', '<=', $now->copy()->addMinutes(5))
            ->get();

        foreach ($quizzes as $quiz) {
            $startTime = $quiz->start_date->setTimezone('Asia/Manila');
            $minutesUntilStart = $now->diffInMinutes($startTime, false);
            
            if ($minutesUntilStart <= 5 && $minutesUntilStart > 0) {
                $count = $this->quizNotificationService->sendQuizReminderNotification($quiz, $minutesUntilStart);
                $notificationsSent += $count;
                $this->line("Sent reminder for '{$quiz->quiz_title}' to {$count} users");
            }
        }

        return $notificationsSent;
    }

    private function sendActivationNotifications()
    {
        $now = Carbon::now('Asia/Manila');
        $notificationsSent = 0;

        $quizzes = \App\Models\Quiz::where('status', 'scheduled')
            ->where('start_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->get();

        foreach ($quizzes as $quiz) {
            $count = $this->quizNotificationService->sendQuizActivatedNotification($quiz);
            $notificationsSent += $count;
            $this->line("Sent activation for '{$quiz->quiz_title}' to {$count} users");
        }

        return $notificationsSent;
    }

    private function sendEndingNotifications()
    {
        $now = Carbon::now('Asia/Manila');
        $notificationsSent = 0;

        $quizzes = \App\Models\Quiz::where('status', 'active')
            ->where('end_date', '>', $now)
            ->where('end_date', '<=', $now->copy()->addMinutes(5))
            ->get();

        foreach ($quizzes as $quiz) {
            $endTime = $quiz->end_date->setTimezone('Asia/Manila');
            $minutesUntilEnd = $now->diffInMinutes($endTime, false);
            
            if ($minutesUntilEnd <= 5 && $minutesUntilEnd > 0) {
                $count = $this->quizNotificationService->sendQuizEndingNotification($quiz, $minutesUntilEnd);
                $notificationsSent += $count;
                $this->line("Sent ending warning for '{$quiz->quiz_title}' to {$count} users");
            }
        }

        return $notificationsSent;
    }

    private function sendEndedNotifications()
    {
        $now = Carbon::now('Asia/Manila');
        $notificationsSent = 0;

        $quizzes = \App\Models\Quiz::where('status', 'active')
            ->where('end_date', '<', $now)
            ->get();

        foreach ($quizzes as $quiz) {
            $count = $this->quizNotificationService->sendQuizEndedNotification($quiz);
            $notificationsSent += $count;
            $this->line("Sent ended notification for '{$quiz->quiz_title}' to {$count} users");
        }

        return $notificationsSent;
    }
}