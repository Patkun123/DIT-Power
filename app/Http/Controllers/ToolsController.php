<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToolsController extends Controller
{
    public function index()
    {
        return view('auth.users.view.physicaltools');
    }

    // BMI calculator
    public function calculate(Request $request)
    {
        $request->validate([
            'weight' => 'required|numeric|min:1',
            'height' => 'required|numeric|min:1',
        ]);

        $weight = $request->weight;
        $height = $request->height / 100; // cm to meters

        $bmi = $weight / ($height * $height);

        $status = '';
        if ($bmi < 18.5) {
            $status = 'Underweight';
        } elseif ($bmi < 24.9) {
            $status = 'Normal weight';
        } elseif ($bmi < 29.9) {
            $status = 'Overweight';
        } else {
            $status = 'Obese';
        }

        return back()->with([
            'bmi' => round($bmi, 2),
            'status' => $status
        ]);
    }

    // Start meditation timer
    public function start(Request $request)
    {
        $request->validate([
            'duration' => 'required|integer|min:1',
        ]);

        $duration = $request->duration;

        // Save start time and duration in session
        session([
            'timer_duration' => $duration,
            'timer_start' => now()->timestamp
        ]);

        return back();
    }

    // Stop meditation timer
    public function stop()
    {
        session()->forget(['timer_duration', 'timer_start']);

        return back();
    }
}
