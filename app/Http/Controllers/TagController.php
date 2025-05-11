<?php
namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    // List all tags
    public function index()
    {
        return response()->json(Tag::with('posts')->paginate(10));
    }

    // Create a new tag
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:tags|max:255',
        ]);

        $tag = Tag::create($validated);

        return response()->json(['message' => 'Tag created', 'tag' => $tag], 201);
    }

    // Show a specific tag with associated posts
    public function show(Tag $tag)
    {
        return response()->json($tag->load('posts'));
    }

    // Update a tag
    public function update(Request $request, Tag $tag)
    {
        
        
        $validated = $request->validate([
            'name' => 'required|string|unique:tags|max:255',
        ]);

        $tag->update($validated);

        return response()->json(['message' => 'Tag updated', 'tag' => $tag]);
    }

    // Delete a tag
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return response()->json(['message' => 'Tag deleted']);
    }
}
