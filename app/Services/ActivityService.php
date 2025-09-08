<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityService
{
    /**
     * Log an activity
     */
    public static function log(
        string $activityType,
        string $title,
        string $description,
        array $metadata = [],
        ?int $userId = null,
        ?Request $request = null
    ): ActivityLog {
        $userId = $userId ?? Auth::id();
        $request = $request ?? request();

        return ActivityLog::create([
            'user_id' => $userId,
            'activity_type' => $activityType,
            'title' => $title,
            'description' => $description,
            'metadata' => $metadata,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }

    /**
     * Log quiz taken activity
     */
    public static function logQuizTaken(int $userId, int $score, int $correct, string $set): ActivityLog
    {
        return self::log(
            'quiz_taken',
            'Quiz Completed',
            "Completed quiz set {$set} with score {$score}/{$correct}",
            [
                'score' => $score,
                'correct' => $correct,
                'set' => $set,
                'percentage' => $correct > 0 ? round(($score / $correct) * 100, 2) : 0
            ],
            $userId
        );
    }

    /**
     * Log user added activity
     */
    public static function logUserAdded(int $userId, string $userName): ActivityLog
    {
        return self::log(
            'user_added',
            'New User Added',
            "Added new user: {$userName}",
            ['user_name' => $userName],
            $userId
        );
    }

    /**
     * Log feedback sent activity
     */
    public static function logFeedbackSent(int $userId, int $rating, string $email): ActivityLog
    {
        return self::log(
            'feedback_sent',
            'Feedback Received',
            "Received feedback from {$email} with rating {$rating}/5",
            ['rating' => $rating, 'email' => $email],
            $userId
        );
    }

    /**
     * Log journal added activity
     */
    public static function logJournalAdded(int $userId, string $title, string $feeling): ActivityLog
    {
        return self::log(
            'journal_added',
            'Journal Entry Added',
            "Added journal entry: {$title}",
            ['title' => $title, 'feeling' => $feeling],
            $userId
        );
    }

    /**
     * Log journal updated activity
     */
    public static function logJournalUpdated(int $userId, string $title): ActivityLog
    {
        return self::log(
            'journal_updated',
            'Journal Entry Updated',
            "Updated journal entry: {$title}",
            ['title' => $title],
            $userId
        );
    }

    /**
     * Log journal deleted activity
     */
    public static function logJournalDeleted(int $userId, string $title): ActivityLog
    {
        return self::log(
            'journal_deleted',
            'Journal Entry Deleted',
            "Deleted journal entry: {$title}",
            ['title' => $title],
            $userId
        );
    }

    /**
     * Log news article created
     */
    public static function logNewsCreated(int $userId, string $title): ActivityLog
    {
        return self::log(
            'news_created',
            'News Article Created',
            "Created news article: {$title}",
            ['title' => $title],
            $userId
        );
    }

    /**
     * Log news article updated
     */
    public static function logNewsUpdated(int $userId, string $title): ActivityLog
    {
        return self::log(
            'news_updated',
            'News Article Updated',
            "Updated news article: {$title}",
            ['title' => $title],
            $userId
        );
    }

    /**
     * Log news article deleted
     */
    public static function logNewsDeleted(int $userId, string $title): ActivityLog
    {
        return self::log(
            'news_deleted',
            'News Article Deleted',
            "Deleted news article: {$title}",
            ['title' => $title],
            $userId
        );
    }

    /**
     * Log user updated
     */
    public static function logUserUpdated(int $userId, string $userName): ActivityLog
    {
        return self::log(
            'user_updated',
            'User Updated',
            "Updated user: {$userName}",
            ['user_name' => $userName],
            $userId
        );
    }

    /**
     * Log user deleted
     */
    public static function logUserDeleted(int $userId, string $userName): ActivityLog
    {
        return self::log(
            'user_deleted',
            'User Deleted',
            "Deleted user: {$userName}",
            ['user_name' => $userName],
            $userId
        );
    }

    /**
     * Log login activity
     */
    public static function logLogin(int $userId): ActivityLog
    {
        return self::log(
            'login',
            'User Login',
            'User logged in successfully',
            [],
            $userId
        );
    }

    /**
     * Log logout activity
     */
    public static function logLogout(int $userId): ActivityLog
    {
        return self::log(
            'logout',
            'User Logout',
            'User logged out',
            [],
            $userId
        );
    }

    /**
     * Log profile updated
     */
    public static function logProfileUpdated(int $userId): ActivityLog
    {
        return self::log(
            'profile_updated',
            'Profile Updated',
            'User updated their profile',
            [],
            $userId
        );
    }

    /**
     * Log password changed
     */
    public static function logPasswordChanged(int $userId): ActivityLog
    {
        return self::log(
            'password_changed',
            'Password Changed',
            'User changed their password',
            [],
            $userId
        );
    }

    /**
     * Log notification sent
     */
    public static function logNotificationSent(int $userId, string $title): ActivityLog
    {
        return self::log(
            'notification_sent',
            'Notification Sent',
            "Sent notification: {$title}",
            ['notification_title' => $title],
            $userId
        );
    }

    /**
     * Get recent activities for dashboard
     */
    public static function getRecentActivities(int $limit = 10)
    {
        return ActivityLog::with('user')
            ->recent(7)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get activity statistics
     */
    public static function getActivityStats()
    {
        $today = now()->startOfDay();
        $thisWeek = now()->startOfWeek();
        $thisMonth = now()->startOfMonth();

        return [
            'today' => ActivityLog::where('created_at', '>=', $today)->count(),
            'this_week' => ActivityLog::where('created_at', '>=', $thisWeek)->count(),
            'this_month' => ActivityLog::where('created_at', '>=', $thisMonth)->count(),
            'total' => ActivityLog::count(),
        ];
    }
}
