<?php

namespace App\Http\Controllers;

use App\Models\news_article;
use Illuminate\Http\Request;
use App\Models\User;
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

        return view('auth.admin.view.dashboard', [
            'totalUsers'       => $totalUsers,
            'weeklyLabels'     => $dates->map(fn($d) => Carbon::parse($d)->format('d F')),
            'weeklyData'       => $weeklyCounts,
            'thisWeekCount'    => $thisWeekCount,
            'percentageChange' => $percentageChange,
            'news_articleCount' => $news_articleCount,
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
