<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
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
            $query->whereHas('tags', fn ($q) => $q->where('tags.slug', $tagId));
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

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.create', compact('categories', 'tags'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    public function store(StorePostRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id() ?? User::value('id');

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('posts', 'public');
        }

        $post = Post::create($data);
        $post->tags()->sync($request->input('tags', []));

        return redirect()->route('posts.show', $post)
            ->with('success', 'Post created successfully.');
    }

    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
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

        return redirect()->route('posts.show', $post)
            ->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully.');
    }
}
