<?php

namespace App\Http\Controllers;

use App\Models\Post; 
use Illuminate\Http\Request;
use Inertia\Inertia;

class BlogController extends Controller
{
    /**
     * Display a listing of the blog posts.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10); // Fetch posts from DB

        return Inertia::render('Blogs/Index', [
            'posts' => $posts,

        ]);
    }


    /**
     * Store a newly created post in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Post::create($validated);

        return redirect()->route('blog.index')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified post.
     */
    public function show($id)
    {
        $post = Post::findOrFail($id); // Fetch the post or return 404 if not found
    
        return Inertia::render('BlogPost', [
            'post' => $post,
            'comments' => $post->comments()->latest()->get(),
        ]);
    }


    /**
     * Update the specified post in the database.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update($validated);

        return redirect()->route('blog.index')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified post from the database.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('blog.index')->with('success', 'Post deleted successfully!');
    }

    
}
