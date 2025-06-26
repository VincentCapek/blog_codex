<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('filter posts by category and tag', function () {
    $category = Category::factory()->create();
    $tag = Tag::factory()->create();

    $post = Post::factory()->create(['category_id' => $category->id]);
    $post->tags()->attach($tag);

    Post::factory()->count(2)->create();

    $response = $this->getJson('/api/posts?category=' . $category->id . '&tag=' . $tag->id);

    $response->assertJsonCount(1, 'data');
});
