<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['category', 'tags'])->where('status', 'published');

        if ($category = $request->query('category')) {
            $query->where('category_id', $category);
        }

        if ($tag = $request->query('tag')) {
            $query->whereHas('tags', fn ($q) => $q->where('id', $tag));
        }

        if ($search = $request->query('q')) {
            $query->whereFullText('title', $search);
        }

        return PostResource::collection($query->paginate(10));
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('posts', 'public');
        }

        $post = Post::create($data);
        $post->tags()->sync($request->input('tags', []));

        return new PostResource($post);
    }

    public function show(Post $post)
    {
        return new PostResource($post->load(['category', 'tags']));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($post->image_path) {
                Storage::disk('public')->delete($post->image_path);
            }
            $data['image_path'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);
        $post->tags()->sync($request->input('tags', []));

        return new PostResource($post);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->noContent();
    }
}
