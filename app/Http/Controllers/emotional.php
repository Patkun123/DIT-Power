<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        return view('Auth.users.view.emotional', compact('quote'));
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
