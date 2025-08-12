<?php

namespace App\Http\Controllers;

use App\Models\news_article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SweetAlert2\Laravel\Swal;
use Illuminate\Support\Facades\Storage;

class ArticleandNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $total     = news_article::count();
        $active    = news_article::where('status', 'published')->count();
        $inactive  = news_article::where('status', 'inactive')->count();
        $drafts    = news_article::where('status', 'draft')->count();
        $archived  = news_article::where('status', 'archived')->count();
        $articles = news_article::latest()->get();
        return view('auth.admin.view.article_news',compact('articles', 'total', 'active', 'inactive', 'drafts', 'archived'));
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
        // Validate incoming request
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'content'           => 'nullable|string',
            'category'          => 'required|string|max:255',
            'status'            => 'nullable|string|max:50',
            'publication_date'  => 'required|date',
            'author'            => 'nullable|string|max:255',
            'summary'           => 'nullable|string|max:500',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB
        ]);

        // Handle image upload if exists
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news_images', 'public');
        }

        // Create slug from title
        $slug = Str::slug($validated['title']);

        // Ensure slug uniqueness
        $count = news_article::where('slug', 'like', "{$slug}%")->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        // Store article
        $article = news_article::create([
            'title'            => $validated['title'],
            'content'          => $validated['content'] ?? null,
            'category'         => $validated['category'],
            'status'           => $validated['status'] ?? 'draft',
            'publication_date' => $validated['publication_date'],
            'author'           => $validated['author'] ?? 'Unknown',
            'summary'          => $validated['summary'] ?? null,
            'image_url'        => $imagePath,
            'slug'             => $slug,
        ]);
        Swal::toastSuccess([
                'title' => 'News created successfully!',
                'position' => 'top-end',
                'showConfirmButton' => false,
                'timer' => 3000,
            ]);
        return redirect()->back()->with('Success', 'Successs.');
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
    public function update(Request $request, news_article  $news_article)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'summary'          => 'required|string|max:500',
            'category'         => 'required|string|max:100',
            'status'           => 'required|in:published,draft,inactive,archived',
            'publication_date' => 'required|date',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        if ($request->hasFile('image')) {
            if ($news_article->image_url) {
                Storage::disk('public')->delete($news_article->image_url);
            }
            $validated['image_url'] = $request->file('image')->store('articles', 'public');
        }

        $news_article->update($validated);

        return redirect()->route('article')->with('success', 'Article updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(news_article $news_article)
    {
        if ($news_article->image_url) {
            Storage::disk('public')->delete($news_article->image_url);
        }

        $news_article->delete();

        return redirect()->route('article')->with('success', 'Article deleted successfully.');
    }
}
