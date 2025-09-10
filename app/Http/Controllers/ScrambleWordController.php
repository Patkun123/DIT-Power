<?php

namespace App\Http\Controllers;

use App\Models\ScrambleWord;
use Illuminate\Http\Request;

class ScrambleWordController extends Controller
{
    public function index(Request $request)
    {
        $words = ScrambleWord::orderBy('word')->paginate(20);
        $editing = null;
        if ($request->filled('edit')) {
            $editing = ScrambleWord::find($request->query('edit'));
        }
        return view('Auth.Admin.view.manage-scramble-words', compact('words', 'editing'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'word' => ['required','string','max:255','unique:scramble_words,word'],
            'set' => ['required','integer','min:1','max:255'],
            'active' => ['nullable','boolean'],
        ]);
        $validated['active'] = $request->boolean('active', true);
        ScrambleWord::create($validated);
        return back()->with('status', 'Word added');
    }

    public function update(Request $request, ScrambleWord $scrambleWord)
    {
        $validated = $request->validate([
            'word' => ['required','string','max:255','unique:scramble_words,word,'.$scrambleWord->id],
            'set' => ['required','integer','min:1','max:255'],
            'active' => ['nullable','boolean'],
        ]);
        $validated['active'] = $request->boolean('active', true);
        $scrambleWord->update($validated);
        return back()->with('status', 'Word updated');
    }

    public function destroy(ScrambleWord $scrambleWord)
    {
        $scrambleWord->delete();
        return back()->with('status', 'Word deleted');
    }
}


