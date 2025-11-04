<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UpcomingEvent;
use App\Models\news_article;
use App\Models\ScrambleWord;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\journals;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminAnalyticsController extends Controller
{
    public function index()
    {
        // User Analytics
        $totalUsers = User::count();
        $activeUsers = User::where('created_at', '>=', now()->subDays(30))->count();
        $newUsersThisWeek = User::where('created_at', '>=', now()->subWeek())->count();
        $newUsersToday = User::whereDate('created_at', today())->count();

        // User Registration Trends (Last 30 days)
        $userRegistrationTrends = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Content Analytics
        $totalEvents = UpcomingEvent::count();
        $publishedEvents = UpcomingEvent::where('status', 'published')->count();
        $totalArticles = news_article::count();
        $publishedArticles = news_article::where('status', 'published')->count();
        $totalScrambleWords = ScrambleWord::count();
        $activeScrambleWords = ScrambleWord::where('active', true)->count();

        // Quiz Analytics
        $totalQuizzes = Quiz::count();
        $activeQuizzes = Quiz::where('status', 'active')->count();
        $totalQuizAttempts = QuizAttempt::count();
        $averageQuizScore = QuizAttempt::avg('score') ?? 0;
        $quizCompletionRate = QuizAttempt::whereNotNull('completed_at')->count() / max($totalQuizAttempts, 1) * 100;

        // Social Analytics
        $totalPosts = Post::count();
        $totalComments = Comment::count();
        $totalLikes = Post::sum('likes_count') + Comment::sum('likes_count');
        $totalJournals = journals::count();

        // Engagement Analytics
        $totalNotifications = Notification::count();
        $unreadNotifications = Notification::whereNull('read_at')->count();
        $notificationReadRate = Notification::whereNotNull('read_at')->count() / max($totalNotifications, 1) * 100;

        // Recent Activity (Last 7 days)
        $recentUsers = User::where('created_at', '>=', now()->subDays(7))->count();
        $recentQuizAttempts = QuizAttempt::where('created_at', '>=', now()->subDays(7))->count();
        $recentPosts = Post::where('created_at', '>=', now()->subDays(7))->count();
        $recentJournals = journals::where('created_at', '>=', now()->subDays(7))->count();

        // Top Performers
        $topQuizPerformers = QuizAttempt::select('user_id', DB::raw('AVG(score) as avg_score'), DB::raw('COUNT(*) as attempts'))
            ->with('user:id,firstname,lastname')
            ->groupBy('user_id')
            ->orderBy('avg_score', 'desc')
            ->limit(5)
            ->get();

        $mostActiveUsers = Post::select('user_id', DB::raw('COUNT(*) as post_count'))
            ->with('user:id,firstname,lastname')
            ->groupBy('user_id')
            ->orderBy('post_count', 'desc')
            ->limit(5)
            ->get();

        // System Health
        $systemHealth = [
            'database_size' => $this->getDatabaseSize(),
            'storage_usage' => $this->getStorageUsage(),
            'last_backup' => $this->getLastBackupDate(),
        ];

        // Chart Data
        $chartData = [
            'user_registration' => $userRegistrationTrends,
            'quiz_attempts' => $this->getQuizAttemptsChart(),
            'content_creation' => $this->getContentCreationChart(),
        ];

        return view('auth.admin.view.analytics', compact(
            'totalUsers',
            'activeUsers',
            'newUsersThisWeek',
            'newUsersToday',
            'totalEvents',
            'publishedEvents',
            'totalArticles',
            'publishedArticles',
            'totalScrambleWords',
            'activeScrambleWords',
            'totalQuizzes',
            'activeQuizzes',
            'totalQuizAttempts',
            'averageQuizScore',
            'quizCompletionRate',
            'totalPosts',
            'totalComments',
            'totalLikes',
            'totalJournals',
            'totalNotifications',
            'unreadNotifications',
            'notificationReadRate',
            'recentUsers',
            'recentQuizAttempts',
            'recentPosts',
            'recentJournals',
            'topQuizPerformers',
            'mostActiveUsers',
            'systemHealth',
            'chartData'
        ));
    }

    private function getDatabaseSize()
    {
        try {
            $size = DB::select("SELECT ROUND(((data_length + index_length) / 1024 / 1024), 2) AS 'DB Size in MB' FROM information_schema.tables WHERE table_schema = ?", [config('database.connections.sqlite.database')]);
            return $size[0]->{'DB Size in MB'} ?? 'N/A';
        } catch (\Exception $e) {
            return 'N/A';
        }
    }

    private function getStorageUsage()
    {
        $storagePath = storage_path();
        $size = 0;
        if (is_dir($storagePath)) {
            $size = $this->getDirectorySize($storagePath);
        }
        return round($size / 1024 / 1024, 2) . ' MB';
    }

    private function getDirectorySize($directory)
    {
        $size = 0;
        foreach (glob(rtrim($directory, '/') . '/*', GLOB_NOSORT) as $each) {
            $size += is_file($each) ? filesize($each) : $this->getDirectorySize($each);
        }
        return $size;
    }

    private function getLastBackupDate()
    {
        // This would typically check your backup system
        return 'Not configured';
    }

    private function getQuizAttemptsChart()
    {
        return QuizAttempt::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    private function getContentCreationChart()
    {
        $posts = Post::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->get();

        $journals = journals::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->get();

        return [
            'posts' => $posts,
            'journals' => $journals
        ];
    }
}
