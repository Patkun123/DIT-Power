<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedbacks;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $email = Auth::user();
        $validated = $request->validate([
            'email' => 'required|integer|min:1|max:5',
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'nullable|string|max:1000',
        ]);

        Feedbacks::create($validated);

        return redirect()->back()->with('success', 'Thank you for your feedback!');
    }
}
