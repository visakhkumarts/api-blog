<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class PostController extends Controller
{

    use AuthorizesRequests;
    // List all posts with user and tags
    public function index()
    {
        $posts = Post::with(['user', 'tags', 'comments'])->latest()->paginate(10);
        return response()->json($posts);
    }

    // Create a new post
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
           'tag_ids' => 'array|exists:tags,id'
        ]);

        $post = Auth::user()->posts()->create([
            'title' => $validated['title'],
            'body' => $validated['body']
        ]);

        if ($request->has('tag_ids')) {
            $post->tags()->attach($validated['tag_ids']);
        }

        return response()->json(['message' => 'Post created', 'post' => $post->load('tags')], 201);
    }

    // Show a specific post with details
    public function show(Post $post)
    {
        $post->load(['user', 'tags', 'comments.user']);
        return response()->json($post);
    }

    // Update a post
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post); // Optional: add policy for security

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'body' => 'sometimes|required|string',
            'tag_ids' => 'nullable|array|exists:tags,id'
        ]);

        $post->update($validated);

        if ($request->has('tag_ids')) {
            $post->tags()->sync($validated['tag_ids']);
        }

        return response()->json(['message' => 'Post updated', 'post' => $post->load('tags')]);
    }

    // Delete a post
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post); // Optional: add policy

        $post->delete();
        return response()->json(['message' => 'Post deleted']);
    }
}
