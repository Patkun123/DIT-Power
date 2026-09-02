<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MoodTracking;
use App\Models\GratitudeEntry;
use App\Models\StressAssessment;
use App\Models\SelfCareLog;
use App\Models\Reflection;
use Carbon\Carbon;

class emotional extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quotes = [
            "Believe in yourself and all that you are.",
            "Every day is a second chance.",
            "Difficult roads often lead to beautiful destinations.",
            "Your only limit is your mind.",
            "Start where you are. Use what you have. Do what you can.",
            "Small progress is still progress.",
            "Push yourself, because no one else is going to do it for you.",
            "Dream it. Wish it. Do it."
        ];

        $quote = $quotes[array_rand($quotes)];

        // Load today's data if user is authenticated
        $todayData = [];
        if (Auth::check()) {
            $today = Carbon::today();
            $stressAssessment = StressAssessment::where('user_id', Auth::id())
                ->whereDate('assessment_date', $today)
                ->latest()
                ->first();

            // Calculate stress label if assessment exists
            $stressLabel = 'Moderate';
            if ($stressAssessment) {
                $level = $stressAssessment->stress_level;
                if ($level <= 3) {
                    $stressLabel = 'Low';
                } elseif ($level <= 6) {
                    $stressLabel = 'Moderate';
                } elseif ($level <= 8) {
                    $stressLabel = 'High';
                } else {
                    $stressLabel = 'Very High';
                }
            }

            $todayData = [
                'mood' => MoodTracking::where('user_id', Auth::id())
                    ->whereDate('tracked_date', $today)
                    ->latest()
                    ->first(),
                'gratitude_entries' => GratitudeEntry::where('user_id', Auth::id())
                    ->whereDate('entry_date', $today)
                    ->latest()
                    ->get(),
                'stress_assessment' => $stressAssessment,
                'stress_label' => $stressLabel,
                'self_care_logs' => SelfCareLog::where('user_id', Auth::id())
                    ->whereDate('log_date', $today)
                    ->get()
                    ->keyBy('activity'),
                'reflection' => Reflection::where('user_id', Auth::id())
                    ->whereDate('reflection_date', $today)
                    ->latest()
                    ->first(),
            ];
        }

        return view('auth.users.view.emotional', compact('quote', 'todayData'));
    }

    /**
     * Store mood tracking
     */
    public function storeMood(Request $request)
    {
        $request->validate([
            'mood' => 'required|string|in:happy,calm,sad,angry,anxious,excited,neutral',
            'notes' => 'nullable|string|max:1000',
        ]);

        $mood = MoodTracking::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'tracked_date' => Carbon::today(),
            ],
            [
                'mood' => $request->mood,
                'notes' => $request->notes,
            ]
        );

        return response()->json(['success' => true, 'mood' => $mood]);
    }

    /**
     * Store gratitude entry
     */
    public function storeGratitude(Request $request)
    {
        $request->validate([
            'entry' => 'required|string|max:500',
        ]);

        $entry = GratitudeEntry::create([
            'user_id' => Auth::id(),
            'entry' => $request->entry,
            'entry_date' => Carbon::today(),
        ]);

        return response()->json(['success' => true, 'entry' => $entry]);
    }

    /**
     * Delete gratitude entry
     */
    public function deleteGratitude($id)
    {
        $entry = GratitudeEntry::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $entry->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Store stress assessment
     */
    public function storeStress(Request $request)
    {
        $request->validate([
            'stress_level' => 'required|integer|min:1|max:10',
            'notes' => 'nullable|string|max:1000',
        ]);

        $assessment = StressAssessment::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'assessment_date' => Carbon::today(),
            ],
            [
                'stress_level' => $request->stress_level,
                'notes' => $request->notes,
            ]
        );

        return response()->json(['success' => true, 'assessment' => $assessment]);
    }

    /**
     * Store self-care log
     */
    public function storeSelfCare(Request $request)
    {
        $request->validate([
            'activity' => 'required|string|in:exercise,meditation,sleep,nutrition,social,hobby',
            'completed' => 'required|boolean',
        ]);

        $log = SelfCareLog::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'activity' => $request->activity,
                'log_date' => Carbon::today(),
            ],
            [
                'completed' => $request->completed,
            ]
        );

        return response()->json(['success' => true, 'log' => $log]);
    }

    /**
     * Store reflection
     */
    public function storeReflection(Request $request)
    {
        $request->validate([
            'what_went_well' => 'nullable|string|max:1000',
            'what_can_improve' => 'nullable|string|max:1000',
        ]);

        $reflection = Reflection::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'reflection_date' => Carbon::today(),
            ],
            [
                'what_went_well' => $request->what_went_well,
                'what_can_improve' => $request->what_can_improve,
            ]
        );

        return response()->json(['success' => true, 'reflection' => $reflection]);
    }
}
