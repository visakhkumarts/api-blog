<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentController extends Controller
{
    use AuthorizesRequests;
    // List comments for a specific post
    public function index(Post $post)
    {
        return response()->json($post->comments()->with('user')->latest()->paginate(10));
    }

    // Create a new comment on a post
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = $post->comments()->create([
            'user_id' => Auth::id(),
            'content' => $validated['content'],
        ]);

        return response()->json(['message' => 'Comment added', 'comment' => $comment->load('user')], 201);
    }

    // Show a specific comment
    public function show(Comment $comment)
    {
        return response()->json($comment->load('user', 'post'));
    }

    // Update a comment
    public function update(Request $request, Comment $comment)
    {
       
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->update($validated);

        return response()->json(['message' => 'Comment updated', 'comment' => $comment]);
    }

    // Delete a comment
    public function destroy(Comment $comment)
    {
        

        $comment->delete();
        return response()->json(['message' => 'Comment deleted']);
    }
}
