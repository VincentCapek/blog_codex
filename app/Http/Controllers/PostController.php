<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['category', 'tags'])->where('status', 'published');

        if ($category = $request->route('category') ?: $request->query('category')) {
            $categoryId = is_object($category) ? $category->id : $category;
            $query->where('category_id', $categoryId);
        }

        if ($tag = $request->route('tag') ?: $request->query('tag')) {
            $tagId = is_object($tag) ? $tag->id : $tag;
            $query->whereHas('tags', fn ($q) => $q->where('id', $tagId));
        }

        if ($search = $request->query('q')) {
            $query->whereFullText('title', $search);
        }

        $posts = $query->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->validated());
        $post->tags()->sync($request->input('tags', []));

        return redirect()->route('posts.show', $post);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());
        $post->tags()->sync($request->input('tags', []));

        return redirect()->route('posts.show', $post);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index');
    }
}
