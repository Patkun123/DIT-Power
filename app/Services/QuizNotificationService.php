<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use App\Models\Quiz;
use Carbon\Carbon;
use App\Events\NotificationSent;

class QuizNotificationService
{
    /**
     * Send notification when a quiz becomes active
     */
    public function sendQuizActivatedNotification(Quiz $quiz)
    {
        $title = "New Quiz Available: {$quiz->quiz_title}";
        $message = "A new quiz '{$quiz->quiz_title}' is now available. Click here to start taking the quiz!";

        // Get all users
        $users = User::where('role', 'user')->get();

        foreach ($users as $user) {
            $notification = Notification::create([
                'user_id' => $user->id,
                'type' => 'quiz_activated',
                'title' => $title,
                'message' => $message,
                'data' => [
                    'quiz_id' => $quiz->id,
                    'quiz_title' => $quiz->quiz_title,
                    'start_time' => $quiz->start_date->setTimezone('Asia/Manila')->toISOString(),
                    'end_time' => $quiz->end_date->setTimezone('Asia/Manila')->toISOString(),
                    'action_url' => route('quiz')
                ]
            ]);
            event(new NotificationSent($notification));
        }

        return $users->count();
    }

    /**
     * Send notification when a quiz is about to start (reminder)
     */
    public function sendQuizReminderNotification(Quiz $quiz, $minutesBefore = 5)
    {
        $title = "Quiz Starting Soon: {$quiz->quiz_title}";
        $message = "Quiz '{$quiz->quiz_title}' will start in {$minutesBefore} minutes. Get ready!";

        // Get all users
        $users = User::where('role', 'user')->get();

        foreach ($users as $user) {
            $notification = Notification::create([
                'user_id' => $user->id,
                'type' => 'quiz_reminder',
                'title' => $title,
                'message' => $message,
                'data' => [
                    'quiz_id' => $quiz->id,
                    'quiz_title' => $quiz->quiz_title,
                    'minutes_before' => $minutesBefore,
                    'start_time' => $quiz->start_date->setTimezone('Asia/Manila')->toISOString(),
                    'action_url' => route('quiz')
                ]
            ]);
            event(new NotificationSent($notification));
        }

        return $users->count();
    }

    /**
     * Send notification when a quiz is about to end
     */
    public function sendQuizEndingNotification(Quiz $quiz, $minutesLeft = 5)
    {
        $title = "Quiz Ending Soon: {$quiz->quiz_title}";
        $message = "Quiz '{$quiz->quiz_title}' will end in {$minutesLeft} minutes. Complete your quiz now!";

        // Get all users
        $users = User::where('role', 'user')->get();

        foreach ($users as $user) {
            $notification = Notification::create([
                'user_id' => $user->id,
                'type' => 'quiz_ending',
                'title' => $title,
                'message' => $message,
                'data' => [
                    'quiz_id' => $quiz->id,
                    'quiz_title' => $quiz->quiz_title,
                    'minutes_left' => $minutesLeft,
                    'end_time' => $quiz->end_date->setTimezone('Asia/Manila')->toISOString(),
                    'action_url' => route('quiz')
                ]
            ]);
            event(new NotificationSent($notification));
        }

        return $users->count();
    }

    /**
     * Send notification when a quiz has ended
     */
    public function sendQuizEndedNotification(Quiz $quiz)
    {
        $title = "Quiz Ended: {$quiz->quiz_title}";
        $message = "Quiz '{$quiz->quiz_title}' has ended. Check your results in the quiz history!";

        // Get all users who attempted the quiz
        $users = User::where('role', 'user')
            ->whereHas('quizAttempts', function($query) use ($quiz) {
                $query->where('quiz_id', $quiz->id);
            })
            ->get();

        foreach ($users as $user) {
            $notification = Notification::create([
                'user_id' => $user->id,
                'type' => 'quiz_ended',
                'title' => $title,
                'message' => $message,
                'data' => [
                    'quiz_id' => $quiz->id,
                    'quiz_title' => $quiz->quiz_title,
                    'end_time' => $quiz->end_date->setTimezone('Asia/Manila')->toISOString(),
                    'action_url' => route('quiz.history')
                ]
            ]);
            event(new NotificationSent($notification));
        }

        return $users->count();
    }

    /**
     * Send notification for upcoming quiz
     */
    public function sendUpcomingQuizNotification(Quiz $quiz)
    {
        $startTime = $quiz->start_date->setTimezone('Asia/Manila');
        $title = "Upcoming Quiz: {$quiz->quiz_title}";
        $message = "Quiz '{$quiz->quiz_title}' is scheduled to start on {$startTime->format('M d, Y \a\t g:i A')} (Philippines time).";

        // Get all users
        $users = User::where('role', 'user')->get();

        foreach ($users as $user) {
            $notification = Notification::create([
                'user_id' => $user->id,
                'type' => 'quiz_upcoming',
                'title' => $title,
                'message' => $message,
                'data' => [
                    'quiz_id' => $quiz->id,
                    'quiz_title' => $quiz->quiz_title,
                    'start_time' => $startTime->toISOString(),
                    'action_url' => route('quiz')
                ]
            ]);
            event(new NotificationSent($notification));
        }

        return $users->count();
    }

    // Legacy methods for backward compatibility
    public function sendQuizStartNotification($set, $startTime = null)
    {
        $startTime = $startTime ?? Carbon::now();

        $title = "Quiz Set {$set} Started!";
        $message = "Quiz Set {$set} is now available. Click here to start taking the quiz!";

        // Get all users
        $users = User::where('role', 'user')->get();

        foreach ($users as $user) {
            $notification = Notification::create([
                'user_id' => $user->id,
                'type' => 'quiz_start',
                'title' => $title,
                'message' => $message,
                'data' => [
                    'set' => $set,
                    'start_time' => $startTime->toISOString(),
                    'action_url' => route('quiz')
                ]
            ]);
            event(new NotificationSent($notification));
        }

        return $users->count();
    }

    public function sendQuizReminderNotificationLegacy($set, $minutesBefore = 5)
    {
        $title = "Quiz Set {$set} Starting Soon!";
        $message = "Quiz Set {$set} will start in {$minutesBefore} minutes. Get ready!";

        // Get all users
        $users = User::where('role', 'user')->get();

        foreach ($users as $user) {
            $notification = Notification::create([
                'user_id' => $user->id,
                'type' => 'quiz_reminder',
                'title' => $title,
                'message' => $message,
                'data' => [
                    'set' => $set,
                    'minutes_before' => $minutesBefore,
                    'action_url' => route('quiz')
                ]
            ]);
            event(new NotificationSent($notification));
        }

        return $users->count();
    }

    public function sendQuizEndNotificationLegacy($set, $minutesLeft = 5)
    {
        $title = "Quiz Set {$set} Ending Soon!";
        $message = "Quiz Set {$set} will end in {$minutesLeft} minutes. Complete your quiz now!";

        // Get all users
        $users = User::where('role', 'user')->get();

        foreach ($users as $user) {
            $notification = Notification::create([
                'user_id' => $user->id,
                'type' => 'quiz_ending',
                'title' => $title,
                'message' => $message,
                'data' => [
                    'set' => $set,
                    'minutes_left' => $minutesLeft,
                    'action_url' => route('quiz')
                ]
            ]);
            event(new NotificationSent($notification));
        }

        return $users->count();
    }

    /**
     * Schedule notifications for all quizzes based on their start/end times
     */
    public function scheduleQuizNotifications()
    {
        $now = Carbon::now('Asia/Manila');
        $notificationsSent = 0;

        // Get all scheduled and active quizzes
        $quizzes = Quiz::whereIn('status', ['scheduled', 'active'])
            ->where('start_date', '>', $now->copy()->subDays(1)) // Only check quizzes from yesterday onwards
            ->get();

        foreach ($quizzes as $quiz) {
            $startTime = $quiz->start_date->setTimezone('Asia/Manila');
            $endTime = $quiz->end_date->setTimezone('Asia/Manila');

            // Check if we're within 5 minutes of quiz start (reminder)
            if ($now->between($startTime->copy()->subMinutes(5), $startTime->copy()->subMinute())) {
                $count = $this->sendQuizReminderNotification($quiz, 5);
                $notificationsSent += $count;
            }

            // Check if quiz has just started (within first minute)
            if ($now->between($startTime, $startTime->copy()->addMinute())) {
                $count = $this->sendQuizActivatedNotification($quiz);
                $notificationsSent += $count;
            }

            // Check if we're within 5 minutes of quiz end (end notification)
            if ($now->between($endTime->copy()->subMinutes(5), $endTime)) {
                $count = $this->sendQuizEndingNotification($quiz, 5);
                $notificationsSent += $count;
            }

            // Check if quiz has just ended
            if ($now->between($endTime, $endTime->copy()->addMinute())) {
                $count = $this->sendQuizEndedNotification($quiz);
                $notificationsSent += $count;
            }
        }

        return $notificationsSent;
    }

    /**
     * Send notifications for newly created quizzes
     */
    public function notifyNewQuizCreated(Quiz $quiz)
    {
        // Only notify if quiz is scheduled for the future
        if ($quiz->start_date->setTimezone('Asia/Manila') > Carbon::now('Asia/Manila')) {
            return $this->sendUpcomingQuizNotification($quiz);
        }

        return 0;
    }
}
