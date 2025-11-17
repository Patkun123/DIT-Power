<?php

namespace App\Http\Controllers;

use App\Models\AdminContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SweetAlert2\Laravel\Swal;

class AdminContentController extends Controller
{
    /**
     * Display a listing of the admin content.
     */
    public function index()
    {
        $contents = AdminContent::with('admin')
            ->latest()
            ->paginate(10);

        $stats = [
            'total' => AdminContent::count(),
            'published' => AdminContent::where('status', 'published')->count(),
            'draft' => AdminContent::where('status', 'draft')->count(),
            'archived' => AdminContent::where('status', 'archived')->count(),
        ];

        return view('auth.admin.view.manage-content', compact('contents', 'stats'));
    }

    /**
     * Show the form for creating new admin content.
     */
    public function create()
    {
        return view('auth.admin.view.create-content');
    }

    /**
     * Store a newly created admin content in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'content' => 'required|string',
            // 5MB max -> specify in kilobytes for Laravel validator
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'status' => 'required|in:draft,published,archived',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('admin-content', 'public');
            $validated['image_url'] = Storage::url($imagePath);
        }

        $validated['admin_id'] = auth()->id();

        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        $content = AdminContent::create($validated);

        return redirect()->route('admin.content.index')
            ->with('success', 'Content created successfully!');
    }

    /**
     * Show the form for editing the specified content.
     */
    public function edit(AdminContent $adminContent)
    {
        $this->authorize('update', $adminContent);
        return view('auth.admin.view.edit-content', ['content' => $adminContent]);
    }

    /**
     * Update the specified content in storage.
     */
    public function update(Request $request, AdminContent $adminContent)
    {
        $this->authorize('update', $adminContent);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'content' => 'required|string',
            // 5MB max -> specify in kilobytes for Laravel validator
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'status' => 'required|in:draft,published,archived',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($adminContent->image_url) {
                $oldPath = str_replace('/storage/', '', $adminContent->image_url);
                Storage::disk('public')->delete($oldPath);
            }

            $image = $request->file('image');
            $imagePath = $image->store('admin-content', 'public');
            $validated['image_url'] = Storage::url($imagePath);
        }

        if ($validated['status'] === 'published' && !$adminContent->published_at) {
            $validated['published_at'] = now();
        }

        $adminContent->update($validated);

        return redirect()->route('admin.content.index')
            ->with('success', 'Content updated successfully!');
    }

    /**
     * Remove the specified content from storage.
     */
    public function destroy(AdminContent $adminContent)
    {
        $this->authorize('delete', $adminContent);

        // Delete image if exists
        if ($adminContent->image_url) {
            $oldPath = str_replace('/storage/', '', $adminContent->image_url);
            Storage::disk('public')->delete($oldPath);
        }

        $adminContent->delete();

        return redirect()->route('admin.content.index')
            ->with('success', 'Content deleted successfully!');
    }
}
