<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;

class QuizNotificationService
{
    public function sendQuizStartNotification($set, $startTime = null)
    {
        $startTime = $startTime ?? Carbon::now();
        
        $title = "Quiz Set {$set} Started!";
        $message = "Quiz Set {$set} is now available. Click here to start taking the quiz!";
        
        // Get all users
        $users = User::where('role', 'user')->get();
        
        foreach ($users as $user) {
            Notification::create([
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
        }
        
        return $users->count();
    }
    
    public function sendQuizReminderNotification($set, $minutesBefore = 5)
    {
        $title = "Quiz Set {$set} Starting Soon!";
        $message = "Quiz Set {$set} will start in {$minutesBefore} minutes. Get ready!";
        
        // Get all users
        $users = User::where('role', 'user')->get();
        
        foreach ($users as $user) {
            Notification::create([
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
        }
        
        return $users->count();
    }
    
    public function sendQuizEndNotification($set, $minutesLeft = 5)
    {
        $title = "Quiz Set {$set} Ending Soon!";
        $message = "Quiz Set {$set} will end in {$minutesLeft} minutes. Complete your quiz now!";
        
        // Get all users
        $users = User::where('role', 'user')->get();
        
        foreach ($users as $user) {
            Notification::create([
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
        }
        
        return $users->count();
    }
    
    public function scheduleQuizNotifications()
    {
        $now = Carbon::now('Asia/Manila');
        
        // Quiz time slots
        $quizSlots = [
            ['set' => 1, 'start' => $now->copy()->setTime(9, 30), 'end' => $now->copy()->setTime(10, 30)],
            ['set' => 2, 'start' => $now->copy()->setTime(12, 0), 'end' => $now->copy()->setTime(13, 0)],
            ['set' => 3, 'start' => $now->copy()->setTime(15, 0), 'end' => $now->copy()->setTime(16, 0)],
        ];
        
        foreach ($quizSlots as $slot) {
            // Check if we're within 5 minutes of quiz start
            if ($now->between($slot['start']->copy()->subMinutes(5), $slot['start'])) {
                // Send reminder notification
                $this->sendQuizReminderNotification($slot['set'], 5);
            }
            
            // Check if quiz has just started
            if ($now->between($slot['start'], $slot['start']->copy()->addMinutes(1))) {
                // Send start notification
                $this->sendQuizStartNotification($slot['set'], $slot['start']);
            }
            
            // Check if we're within 5 minutes of quiz end
            if ($now->between($slot['end']->copy()->subMinutes(5), $slot['end'])) {
                // Send end notification
                $this->sendQuizEndNotification($slot['set'], 5);
            }
        }
    }
}
