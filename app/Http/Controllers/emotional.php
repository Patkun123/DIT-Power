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
            // Encouragement
            "Believe in yourself and all that you are.",
            "Every day is a second chance.",
            "Difficult roads often lead to beautiful destinations.",
            "Your only limit is your mind.",
            "Start where you are. Use what you have. Do what you can.",
            "Small progress is still progress.",
            "Push yourself, because no one else is going to do it for you.",
            "Dream it. Wish it. Do it.",
            "You are stronger than you think.",
            "Keep going. You are making progress.",
            "One step at a time is still moving forward.",
            "Don't give up. Your story isn't finished yet.",
            "You don't have to be perfect to make progress.",
            "Better days are ahead.",
            "Be proud of how far you've come.",
            "Your effort today builds your strength tomorrow.",
            "Even the smallest step forward matters.",
            "You can do hard things.",
            "Take a breath, reset, and try again.",
            "Progress takes patience. Keep going.",
            "You are capable of more than you realize.",
            "Don't let one difficult day define your journey.",
            "Your future needs the courage you have today.",
            "Keep believing. Keep growing. Keep moving.",
            "You have overcome difficult days before. You can do it again.",
            "It's okay to rest. Rest is part of the journey.",
            "Give yourself permission to start again.",
            "You are doing better than you think.",
            "Your journey is unique. Don't compare it to someone else's.",
            "Keep moving forward, even if the steps are small.",

            // Strength & Courage
            "\"I can do all things through Christ who strengthens me.\" — Philippians 4:13",
            "\"Be strong and courageous. Do not be afraid; do not be discouraged.\" — Joshua 1:9",
            "\"The Lord is my strength and my shield.\" — Psalm 28:7",
            "\"God is our refuge and strength, an ever-present help in trouble.\" — Psalm 46:1",
            "\"The Lord is my shepherd; I shall not want.\" — Psalm 23:1",
            "\"Those who hope in the Lord will renew their strength.\" — Isaiah 40:31",
            "\"My grace is sufficient for you, for my power is made perfect in weakness.\" — 2 Corinthians 12:9",
            "\"The Lord is my light and my salvation—whom shall I fear?\" — Psalm 27:1",
            "\"The Lord is the strength of my life; of whom shall I be afraid?\" — Psalm 27:1",
            "\"The Lord gives strength to his people; the Lord blesses his people with peace.\" — Psalm 29:11",

            // Hope
            "\"For I know the plans I have for you,\" declares the Lord, \"plans to prosper you and not to harm you, plans to give you hope and a future.\" — Jeremiah 29:11",
            "\"Weeping may endure for a night, but joy comes in the morning.\" — Psalm 30:5",
            "\"May the God of hope fill you with all joy and peace as you trust in Him.\" — Romans 15:13",
            "\"The Lord is good, a refuge in times of trouble.\" — Nahum 1:7",
            "\"Cast all your anxiety on Him because He cares for you.\" — 1 Peter 5:7",
            "\"The Lord is near to all who call on Him.\" — Psalm 145:18",
            "\"When I am afraid, I put my trust in You.\" — Psalm 56:3",
            "\"Hope in the Lord; for with the Lord there is mercy.\" — Psalm 130:7",

            // Peace
            "\"Peace I leave with you; my peace I give you.\" — John 14:27",
            "\"Be still, and know that I am God.\" — Psalm 46:10",
            "\"You will keep in perfect peace those whose minds are steadfast, because they trust in You.\" — Isaiah 26:3",
            "\"Do not be anxious about anything, but in every situation, by prayer and petition, present your requests to God.\" — Philippians 4:6",
            "\"The peace of God, which transcends all understanding, will guard your hearts and your minds.\" — Philippians 4:7",
            "\"Come to me, all you who are weary and burdened, and I will give you rest.\" — Matthew 11:28",

            // Perseverance
            "\"Let us not become weary in doing good, for at the proper time we will reap a harvest if we do not give up.\" — Galatians 6:9",
            "\"Consider it pure joy whenever you face trials of many kinds, because you know that the testing of your faith produces perseverance.\" — James 1:2-3",
            "\"Run with perseverance the race marked out for us.\" — Hebrews 12:1",
            "\"Blessed is the one who perseveres under trial.\" — James 1:12",
            "\"Let perseverance finish its work so that you may be mature and complete.\" — James 1:4",
            "\"I press on toward the goal to win the prize.\" — Philippians 3:14",

            // Healing & Renewal
            "\"He heals the brokenhearted and binds up their wounds.\" — Psalm 147:3",
            "\"He gives strength to the weary and increases the power of the weak.\" — Isaiah 40:29",
            "\"He restores my soul.\" — Psalm 23:3",
            "\"Create in me a pure heart, O God, and renew a steadfast spirit within me.\" — Psalm 51:10",
            "\"Therefore, if anyone is in Christ, the new creation has come.\" — 2 Corinthians 5:17",
            "\"He refreshes my soul. He guides me along the right paths.\" — Psalm 23:3",

            // Trust & Faith
            "\"Trust in the Lord with all your heart and lean not on your own understanding.\" — Proverbs 3:5",
            "\"The Lord will fight for you; you need only to be still.\" — Exodus 14:14",
            "\"When I am afraid, I put my trust in You.\" — Psalm 56:3",
            "\"Commit to the Lord whatever you do, and He will establish your plans.\" — Proverbs 16:3",
            "\"The Lord is near to all who call on Him.\" — Psalm 145:18",
            "\"Do not let your hearts be troubled. You believe in God; believe also in me.\" — John 14:1",

            // Gratitude & Daily Life
            "\"This is the day the Lord has made; let us rejoice and be glad in it.\" — Psalm 118:24",
            "\"Let all that you do be done in love.\" — 1 Corinthians 16:14",
            "\"Whatever you do, work at it with all your heart.\" — Colossians 3:23",
            "\"Give thanks to the Lord, for He is good; His love endures forever.\" — Psalm 107:1",
            "\"Give thanks in all circumstances; for this is God's will for you in Christ Jesus.\" — 1 Thessalonians 5:18",
            "\"Above all else, guard your heart, for everything you do flows from it.\" — Proverbs 4:23",

            // Wisdom & Guidance
            "\"Your word is a lamp for my feet, a light on my path.\" — Psalm 119:105",
            "\"In all your ways acknowledge Him, and He will make your paths straight.\" — Proverbs 3:6",
            "\"The Lord directs the steps of the godly.\" — Psalm 37:23",
            "\"If any of you lacks wisdom, you should ask God, who gives generously to all.\" — James 1:5",

            // Love & Kindness
            "\"Let everything you do be done in love.\" — 1 Corinthians 16:14",
            "\"Above all, love each other deeply.\" — 1 Peter 4:8",
            "\"Be kind and compassionate to one another.\" — Ephesians 4:32",
            "\"Love is patient, love is kind.\" — 1 Corinthians 13:4",
            "\"And now these three remain: faith, hope and love. But the greatest of these is love.\" — 1 Corinthians 13:13",

            // Motivation
            "Your current situation is not your final destination.",
            "Don't be afraid of slow progress. Be afraid of standing still.",
            "A difficult day does not mean a difficult life.",
            "You don't need to have everything figured out today.",
            "Give yourself the same encouragement you give to others.",
            "You are allowed to take things one day at a time.",
            "Every morning is another opportunity to begin again.",
            "Keep showing up for yourself.",
            "Your small victories deserve to be celebrated.",
            "You are growing through what you are going through.",
            "Sometimes making it through the day is an achievement.",
            "Choose hope, even when the road feels uncertain.",
            "Your journey matters.",
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
