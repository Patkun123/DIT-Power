<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index(): JsonResponse
    {
        $notes = Auth::user()->notes()
            ->orderBy('is_important', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($notes);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'required|string|max:1000',
            'is_important' => 'boolean'
        ]);

        $note = Auth::user()->notes()->create([
            'title' => $request->title,
            'content' => $request->content,
            'is_important' => $request->boolean('is_important', false)
        ]);

        return response()->json($note, 201);
    }

    public function update(Request $request, Note $note): JsonResponse
    {
        // Ensure the note belongs to the authenticated user
        if ($note->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'required|string|max:1000',
            'is_important' => 'boolean'
        ]);

        $note->update([
            'title' => $request->title,
            'content' => $request->content,
            'is_important' => $request->boolean('is_important', false)
        ]);

        return response()->json($note);
    }

    public function destroy(Note $note): JsonResponse
    {
        // Ensure the note belongs to the authenticated user
        if ($note->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $note->delete();

        return response()->json(['message' => 'Note deleted successfully']);
    }

    public function toggleImportant(Note $note): JsonResponse
    {
        // Ensure the note belongs to the authenticated user
        if ($note->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $note->update(['is_important' => !$note->is_important]);

        return response()->json($note);
    }
}
