<?php

namespace App\Http\Controllers;

use App\Models\UpcomingEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use SweetAlert2\Laravel\Swal;

class UpcomingEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $total = UpcomingEvent::count();
        $active = UpcomingEvent::where('status', 'published')->count();
        $inactive = UpcomingEvent::where('status', 'inactive')->count();
        $drafts = UpcomingEvent::where('status', 'draft')->count();
        $archived = UpcomingEvent::where('status', 'archived')->count();
        $events = UpcomingEvent::latest()->get();

        return view('auth.admin.view.upcoming_events', compact('events', 'total', 'active', 'inactive', 'drafts', 'archived'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'category' => 'required|string|max:255',
            'status' => 'nullable|string|max:50',
            'event_date' => 'required|date',
            'end_date' => 'nullable|date|after:event_date',
            'location' => 'nullable|string|max:255',
            'organizer' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
            'summary' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('event_images', 'public');
        }

        $slug = Str::slug($validated['title']);
        $count = UpcomingEvent::where('slug', 'like', "{$slug}%")->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        UpcomingEvent::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'content' => $validated['content'] ?? null,
            'category' => $validated['category'],
            'status' => $validated['status'] ?? 'draft',
            'event_date' => $validated['event_date'],
            'end_date' => $validated['end_date'] ?? null,
            'location' => $validated['location'] ?? null,
            'organizer' => $validated['organizer'] ?? null,
            'author' => $validated['author'] ?? 'Unknown',
            'summary' => $validated['summary'] ?? null,
            'image_url' => $imagePath,
            'slug' => $slug,
        ]);

        Swal::toastSuccess([
            'title' => 'Event created successfully!',
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 3000,
        ]);

        return redirect()->back()->with('success', 'Event created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UpcomingEvent $upcomingEvent)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'category' => 'required|string|max:100',
            'status' => 'required|in:published,draft,inactive,archived',
            'event_date' => 'required|date',
            'end_date' => 'nullable|date|after:event_date',
            'location' => 'nullable|string|max:255',
            'organizer' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
            'summary' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120',
        ]);

        if ($request->hasFile('image')) {
            if ($upcomingEvent->image_url && Storage::disk('public')->exists($upcomingEvent->image_url)) {
                Storage::disk('public')->delete($upcomingEvent->image_url);
            }
            $validated['image_url'] = $request->file('image')->store('event_images', 'public');
        }

        if ($upcomingEvent->title !== $validated['title']) {
            $slug = Str::slug($validated['title']);
            $count = UpcomingEvent::where('slug', 'like', "{$slug}%")
                ->where('id', '!=', $upcomingEvent->id)
                ->count();
            if ($count > 0) {
                $slug .= '-' . ($count + 1);
            }
            $validated['slug'] = $slug;
        }

        $upcomingEvent->update($validated);

        Swal::toastSuccess([
            'title' => 'Event updated successfully!',
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 3000,
        ]);

        return redirect()->route('upcoming-events')->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UpcomingEvent $upcomingEvent)
    {
        if ($upcomingEvent->image_url && Storage::disk('public')->exists($upcomingEvent->image_url)) {
            Storage::disk('public')->delete($upcomingEvent->image_url);
        }

        $upcomingEvent->delete();

        Swal::toastSuccess([
            'title' => 'Event deleted successfully!',
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 3000,
        ]);

        return redirect()->route('upcoming-events')->with('success', 'Event deleted successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UpcomingEvent $upcomingEvent)
    {
        return response()->json([
            'id' => $upcomingEvent->id,
            'title' => $upcomingEvent->title,
            'description' => $upcomingEvent->description,
            'content' => $upcomingEvent->content,
            'category' => $upcomingEvent->category,
            'status' => $upcomingEvent->status,
            'event_date' => $upcomingEvent->event_date->format('Y-m-d\TH:i'),
            'end_date' => $upcomingEvent->end_date ? $upcomingEvent->end_date->format('Y-m-d\TH:i') : null,
            'location' => $upcomingEvent->location,
            'organizer' => $upcomingEvent->organizer,
            'author' => $upcomingEvent->author,
            'summary' => $upcomingEvent->summary,
            'image_url' => $upcomingEvent->image_url,
        ]);
    }

    /**
     * Get published events for public display
     */
    public function getPublishedEvents()
    {
        return UpcomingEvent::published()
            ->upcoming()
            ->orderBy('event_date', 'asc')
            ->limit(3)
            ->get();
    }
}
