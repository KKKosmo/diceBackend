<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Support\Carbon;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
    
        foreach ($posts as $post) {
            $post->date = Carbon::parse($post->created_at)->format('m/d/Y g:i A');
        }
    
        return response()->json($posts);
    }

    public function show($id)
    {
        return response()->json($post);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $user_id = Auth::id();

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $user_id,
        ]);

        return response()->json($post, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::findOrFail($id);
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json($post, 200);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json(null, 204);
    }
}
