<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'name' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        $request->user()->comments()->create([
            'post_id' => $request->post_id,
            'body' => $request->body,
            'name' => $request->name,
            'user_id' => $request->user()->id,
        ]);

        // Comment::create([
        //     'post_id' => $request->post_id,
        //     'name' => $request->name,
        //     'body' => $request->body,
        //     'user_id' => $request->user()->id,
        // ]);

        return back(); // Redirect back to the post after adding a comment
    }
}
