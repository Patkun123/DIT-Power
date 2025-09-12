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
     * Log quiz created
     */
    public static function logQuizCreated(int $userId, string $quizTitle): ActivityLog
    {
        return self::log(
            'quiz_created',
            'Quiz Created',
            "Created quiz: {$quizTitle}",
            ['quiz_title' => $quizTitle],
            $userId
        );
    }

    /**
     * Log quiz updated
     */
    public static function logQuizUpdated(int $userId, string $quizTitle): ActivityLog
    {
        return self::log(
            'quiz_updated',
            'Quiz Updated',
            "Updated quiz: {$quizTitle}",
            ['quiz_title' => $quizTitle],
            $userId
        );
    }

    /**
     * Log quiz deleted
     */
    public static function logQuizDeleted(int $userId, string $quizTitle): ActivityLog
    {
        return self::log(
            'quiz_deleted',
            'Quiz Deleted',
            "Deleted quiz: {$quizTitle}",
            ['quiz_title' => $quizTitle],
            $userId
        );
    }

    /**
     * Log question created
     */
    public static function logQuestionCreated(int $userId, string $questionContent, string $quizTitle): ActivityLog
    {
        return self::log(
            'question_created',
            'Question Created',
            "Created question for quiz: {$quizTitle}",
            ['question_content' => $questionContent, 'quiz_title' => $quizTitle],
            $userId
        );
    }

    /**
     * Log question updated
     */
    public static function logQuestionUpdated(int $userId, string $questionContent, string $quizTitle): ActivityLog
    {
        return self::log(
            'question_updated',
            'Question Updated',
            "Updated question for quiz: {$quizTitle}",
            ['question_content' => $questionContent, 'quiz_title' => $quizTitle],
            $userId
        );
    }

    /**
     * Log question deleted
     */
    public static function logQuestionDeleted(int $userId, string $questionContent, string $quizTitle): ActivityLog
    {
        return self::log(
            'question_deleted',
            'Question Deleted',
            "Deleted question from quiz: {$quizTitle}",
            ['question_content' => $questionContent, 'quiz_title' => $quizTitle],
            $userId
        );
    }

    /**
     * Log quiz activated activity
     */
    public static function logQuizActivated(string $userId, string $quizTitle, string $activatedAt): ActivityLog
    {
        return self::log(
            'quiz_activated',
            'Quiz Activated',
            "Quiz '{$quizTitle}' was automatically activated at {$activatedAt} (Philippines time)",
            ['quiz_title' => $quizTitle, 'activated_at' => $activatedAt],
            $userId === 'system' ? 1 : $userId // Use admin user ID for system activations
        );
    }

    /**
     * Log quiz set created
     */
    public static function logQuizSetCreated(int $userId, string $setName, string $quizTitle): ActivityLog
    {
        return self::log(
            'quiz_set_created',
            'Quiz Set Created',
            "Created set '{$setName}' for quiz: {$quizTitle}",
            ['set_name' => $setName, 'quiz_title' => $quizTitle],
            $userId
        );
    }

    /**
     * Log quiz set updated
     */
    public static function logQuizSetUpdated(int $userId, string $setName, string $quizTitle): ActivityLog
    {
        return self::log(
            'quiz_set_updated',
            'Quiz Set Updated',
            "Updated set '{$setName}' for quiz: {$quizTitle}",
            ['set_name' => $setName, 'quiz_title' => $quizTitle],
            $userId
        );
    }

    /**
     * Log quiz set deleted
     */
    public static function logQuizSetDeleted(int $userId, string $setName, string $quizTitle): ActivityLog
    {
        return self::log(
            'quiz_set_deleted',
            'Quiz Set Deleted',
            "Deleted set '{$setName}' from quiz: {$quizTitle}",
            ['set_name' => $setName, 'quiz_title' => $quizTitle],
            $userId
        );
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
