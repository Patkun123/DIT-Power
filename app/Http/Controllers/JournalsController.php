<?php

namespace App\Http\Controllers;

use App\Models\journals;
use App\Services\ActivityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JournalsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $journals = journals::where('user_id', Auth::id())
                        ->latest()
                        ->get();

        return view('auth.users.view.journal', [
            'journals' => $journals,
            'hasEntries' => $journals->isNotEmpty()
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
        // Ensure the user is authenticated
        $user = Auth::user();

        $validated = $request->validate([
            'title'   => ['required', 'string', 'max:255'],
            'text'    => ['required', 'string'],
            'feeling' => ['required', 'string'],
            'tags'    => ['nullable', 'string'],
        ]);

        $journal = journals::create([
            'user_id' => $user->id,
            'title'   => $validated['title'],
            'text'    => $validated['text'],
            'feeling' => $validated['feeling'],
            'tags'    => $validated['tags'] ?? '',
        ]);

        // Log journal activity
        ActivityService::logJournalAdded(
            $user->id,
            $validated['title'],
            $validated['feeling']
        );

        return redirect()
            ->route('journal')
            ->with('success', 'Journal entry saved.');
    }

    /**
     * Display the specified resource.
     */
    public function show(journals $jornals)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request, $id)
    {
        $journal = Journals::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'feeling' => 'required|string',
            'tags' => 'nullable|string',
        ]);

        $journal->update($request->only(['title', 'text', 'feeling', 'tags']));

        // Log journal update activity
        ActivityService::logJournalUpdated(
            $journal->user_id,
            $journal->title
        );

        return redirect()->back()->with('success', 'Journal updated successfully.');
}


    /**
     * Update the specified resource in storage.
     */
    public function edit(Request $request, journals $jornals)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $journal = Journals::findOrFail($id);
        $title = $journal->title;
        $userId = $journal->user_id;

        $journal->delete();

        // Log journal delete activity
        ActivityService::logJournalDeleted($userId, $title);

        return redirect()->back()->with('success', 'Journal deleted successfully.');
    }

}
