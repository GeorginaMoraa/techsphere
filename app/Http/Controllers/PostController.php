<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Display posts with optional search & category filters
    public function index(Request $request)
    {
        $posts = Post::where('is_active', true)
            ->when($request->search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%");
            })
            ->when($request->category, function ($query, $category) {
                return $query->where('category', $category);
            })
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Posts/Index', [
            'posts' => $posts,
            'filters' => request()->only('search', 'category'),
        ]);
    }

    // Show the post creation form
    public function create()
    {
        return Inertia::render('Posts/Create', [
            'categories' => Post::distinct()->pluck('category'),
        ]);
    }

    // Store a new post with an image upload
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('posts', 'public');
        }
        $validatedData['user_id'] = auth()->id();

        Post::create($validatedData);

        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }

    // Show a single post
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return Inertia::render('Posts/Show', [
            'post' => $post,
        ]);
    }

    // Show the edit form with existing post data
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return Inertia::render('Posts/Edit', [
            'post' => $post,
            'categories' => Post::distinct()->pluck('category'),
        ]);
    }

    // Update an existing post with a new image if provided
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($post->image) {
                Storage::delete('public/' . $post->image);
            }
            $validatedData['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($validatedData);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    // Delete a post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Delete the image if it exists
        if ($post->image) {
            Storage::delete('public/' . $post->image);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}
