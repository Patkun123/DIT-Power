<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of events
     */
    public function index()
    {
        $events = Event::latest()
            ->paginate(10);

        $stats = [
            'total' => Event::count(),
            'active' => Event::where('status', 'active')->count(),
            'completed' => Event::where('status', 'completed')->count(),
            'cancelled' => Event::where('status', 'cancelled')->count(),
        ];

        return view('auth.admin.view.manage-events', compact('events', 'stats'));
    }

    /**
     * Show the form for creating new event
     */
    public function create()
    {
        return view('auth.admin.view.create-event');
    }

    /**
     * Store a newly created event
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'event_date' => 'required|date|after_or_equal:today',
            'event_time' => 'required|date_format:H:i',
            'status' => 'required|in:active,completed,cancelled',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('events', 'public');
            $validated['image_url'] = Storage::url($imagePath);
        }

        $validated['admin_id'] = auth()->id();

        Event::create($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event created successfully!');
    }

    /**
     * Show the form for editing event
     */
    public function edit(Event $event)
    {
        $this->authorize('update', $event);
        return view('auth.admin.view.edit-event', compact('event'));
    }

    /**
     * Update the specified event
     */
    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_time' => 'required|date_format:H:i',
            'status' => 'required|in:active,completed,cancelled',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($event->image_url) {
                $oldPath = str_replace('/storage/', '', $event->image_url);
                Storage::disk('public')->delete($oldPath);
            }

            $image = $request->file('image');
            $imagePath = $image->store('events', 'public');
            $validated['image_url'] = Storage::url($imagePath);
        }

        $event->update($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event updated successfully!');
    }

    /**
     * Delete the specified event
     */
    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);

        // Delete image if exists
        if ($event->image_url) {
            $oldPath = str_replace('/storage/', '', $event->image_url);
            Storage::disk('public')->delete($oldPath);
        }

        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event deleted successfully!');
    }
}
