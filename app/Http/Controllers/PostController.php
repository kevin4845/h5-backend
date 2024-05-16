<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return Post::all();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while fetching posts'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        return Auth::user();
        try {
            $post = Post::create([
                "name" => $request->get('name'),
                "description" => $request->get('description'),
                "price" => $request->get('price'),
                "user_id" => Auth::id()
            ]);
            return response()->json(['message' => 'Post created successfully'], 201);
        } catch (\Throwable $th) {
            return $th;
            return response()->json(['message' => 'An error occurred while creating a post'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        try {
            return $post;
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while fetching the post'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        try {
            $post->update($request->all());
            return response()->json(['message' => 'Post updated successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while updating the post'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        try {
            $post->delete();
            return response()->json(['message' => 'Post deleted successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while deleting the post'], 500);
        }
    }
}
