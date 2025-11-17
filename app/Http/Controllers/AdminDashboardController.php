<?php

namespace App\Http\Controllers;

use App\Models\news_article;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\QuizAttempt;
use App\Models\user_information;
use App\Models\Feedbacks;
use App\Models\journals;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalUsers = User::count();

        // Generate last 7 days dates
        $dates = collect();
        for ($i = 6; $i >= 0; $i--) {
            $dates->push(Carbon::today()->subDays($i)->format('Y-m-d'));
        }

        // Get counts for each day
        $weeklyCounts = $dates->map(function ($date) {
            return User::whereDate('created_at', $date)->count();
        });

        $news_articleCount = news_article::count();

        // Calculate percentage change from previous week
        $lastWeekCount = User::whereBetween('created_at', [
            Carbon::today()->subDays(14),
            Carbon::today()->subDays(7)
        ])->count();

        $thisWeekCount = $weeklyCounts->sum();

        $percentageChange = $lastWeekCount == 0
            ? ($thisWeekCount > 0 ? 100 : 0)
            : round((($thisWeekCount - $lastWeekCount) / $lastWeekCount) * 100, 2);

        // Quiz attempts per day (unique users who took a quiz each day)
        $quizDailyLabels = $dates->map(fn($d) => Carbon::parse($d)->format('D'));
        $quizDailyCounts = $dates->map(function ($date) {
            return QuizAttempt::whereDate('created_at', $date)
                ->distinct('user_id')
                ->count('user_id');
        });

        // Age distribution buckets from user_information birthdays
        $now = Carbon::now();
        $age20MaxBirthdate = $now->copy()->subYears(20); // youngest in 20-30 was born after this
        $age30MinBirthdate = $now->copy()->subYears(30); // oldest in 20-30
        $age31MaxBirthdate = $now->copy()->subYears(31);
        $age35MinBirthdate = $now->copy()->subYears(35);
        $age36MinBirthdate = $now->copy()->subYears(36);

        // 20-30 inclusive
        $bucket20to30 = user_information::whereNotNull('birthday')
            ->whereBetween('birthday', [$age30MinBirthdate->toDateString(), $age20MaxBirthdate->toDateString()])
            ->count();

        // 31-35 inclusive
        $bucket31to35 = user_information::whereNotNull('birthday')
            ->whereBetween('birthday', [$age35MinBirthdate->toDateString(), $age31MaxBirthdate->toDateString()])
            ->count();

        // 36+
        $bucket36plus = user_information::whereNotNull('birthday')
            ->where('birthday', '<=', $age36MinBirthdate->toDateString())
            ->count();

        $ageLabels = collect(['20-30', '31-35', '36+']);
        $ageCounts = collect([$bucket20to30, $bucket31to35, $bucket36plus]);

        // Feedback statistics
        $totalFeedbacks = Feedbacks::count();
        $averageRating = Feedbacks::avg('rating') ?? 0;
        $recentFeedbacks = Feedbacks::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $monthlyFeedbacks = Feedbacks::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // Analysis metrics
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();

        $analysis = [
            'users_today' => User::whereDate('created_at', $today)->count(),
            'users_this_month' => User::where('created_at', '>=', $startOfMonth)->count(),
            'quizzes_today' => QuizAttempt::whereDate('created_at', $today)->count(),
            'avg_quiz_score_today' => round((float) (QuizAttempt::whereDate('created_at', $today)->avg('score') ?? 0), 2),
            'journals_today' => journals::whereDate('created_at', $today)->count(),
            'feedbacks_today' => Feedbacks::whereDate('created_at', $today)->count(),
            'avg_rating_this_month' => round((float) (Feedbacks::where('created_at', '>=', $startOfMonth)->avg('rating') ?? 0), 2),
            'active_users_today' => collect([
                QuizAttempt::whereDate('created_at', $today)->distinct('user_id')->count('user_id'),
                journals::whereDate('created_at', $today)->distinct('user_id')->count('user_id'),
                Feedbacks::whereDate('created_at', $today)->distinct('email')->count('email'),
            ])->max(),
        ];

        return view('auth.admin.view.dashboard', [
            'totalUsers'       => $totalUsers,
            'weeklyLabels'     => $dates->map(fn($d) => Carbon::parse($d)->format('d F')),
            'weeklyData'       => $weeklyCounts,
            'thisWeekCount'    => $thisWeekCount,
            'percentageChange' => $percentageChange,
            'news_articleCount' => $news_articleCount,
            // charts
            'quizDailyLabels'  => $quizDailyLabels,
            'quizDailyCounts'  => $quizDailyCounts,
            'ageLabels'        => $ageLabels,
            'ageCounts'        => $ageCounts,
            // feedback stats
            'totalFeedbacks'   => $totalFeedbacks,
            'averageRating'    => round($averageRating, 2),
            'recentFeedbacks'  => $recentFeedbacks,
            'monthlyFeedbacks' => $monthlyFeedbacks,
            'analysis'        => $analysis,
            // upcoming events
            'upcomingEvents'   => Event::upcoming()->limit(5)->get(),
        ]);
    }
    public function getUsersByRange(Request $request)
    {
        $range = $request->input('range', '7'); // default to last 7 days
        $today = Carbon::today();

        switch ($range) {
            case 'today':
                $dates = collect([$today->format('Y-m-d')]);
                break;
            case 'yesterday':
                $dates = collect([$today->subDay()->format('Y-m-d')]);
                break;
            case '30':
                $days = 30;
                $dates = collect();
                for ($i = $days - 1; $i >= 0; $i--) {
                    $dates->push(Carbon::today()->subDays($i)->format('Y-m-d'));
                }
                break;
            case '90':
                $days = 90;
                $dates = collect();
                for ($i = $days - 1; $i >= 0; $i--) {
                    $dates->push(Carbon::today()->subDays($i)->format('Y-m-d'));
                }
                break;
            default: // last 7 days
                $days = 7;
                $dates = collect();
                for ($i = $days - 1; $i >= 0; $i--) {
                    $dates->push(Carbon::today()->subDays($i)->format('Y-m-d'));
                }
                break;
        }

        $data = $dates->map(function ($date) {
            return User::whereDate('created_at', $date)->count();
        });

        return response()->json([
            'labels' => $dates->map(fn($d) => Carbon::parse($d)->format('d F')),
            'series' => $data,
            'total' => $data->sum()
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
