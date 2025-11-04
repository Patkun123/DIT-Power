<?php

namespace App\Http\Controllers;

use App\Models\ScrambleWord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScrambleWordController extends Controller
{
    public function index(Request $request)
    {
        $query = ScrambleWord::query();

        // Search functionality
        if ($request->filled('search')) {
            $query->where('word', 'like', '%' . $request->search . '%');
        }

        // Filter by set
        if ($request->filled('set')) {
            $query->where('set', $request->set);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('active', $request->status === 'active');
        }

        $words = $query->orderBy('word')->paginate(20);
        $editing = null;
        if ($request->filled('edit')) {
            $editing = ScrambleWord::find($request->query('edit'));
        }

        // Get statistics for the dashboard
        $stats = [
            'total' => ScrambleWord::count(),
            'active' => ScrambleWord::where('active', true)->count(),
            'inactive' => ScrambleWord::where('active', false)->count(),
            'by_set' => DB::table('scramble_words')
                ->select('set', DB::raw('COUNT(*) as count'))
                ->groupBy('set')
                ->orderBy('set')
                ->get()
                ->pluck('count', 'set')
        ];

        return view('Auth.Admin.view.manage-scramble-words', compact('words', 'editing', 'stats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'word' => ['required', 'string', 'max:255', 'unique:scramble_words,word'],
            'set' => ['required', 'integer', 'min:1', 'max:255'],
            'active' => ['nullable', 'boolean'],
        ]);
        $validated['active'] = $request->boolean('active', true);
        ScrambleWord::create($validated);
        return back()->with('status', 'Word added');
    }

    public function update(Request $request, ScrambleWord $scrambleWord)
    {
        $validated = $request->validate([
            'word' => ['required', 'string', 'max:255', 'unique:scramble_words,word,' . $scrambleWord->id],
            'set' => ['required', 'integer', 'min:1', 'max:255'],
            'active' => ['nullable', 'boolean'],
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
