<?php

use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('author can store post', function () {
    $user = User::factory()->create(['role' => 'author']);
    $category = Category::factory()->create();
    $tags = Tag::factory()->count(2)->create();

    $response = $this->actingAs($user)->post('/posts', [
        'title' => 'My Post',
        'slug' => 'my-post',
        'content' => 'Content',
        'category_id' => $category->id,
        'tags' => $tags->pluck('id')->toArray(),
        'status' => 'published',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');
    $this->assertDatabaseHas('posts', ['slug' => 'my-post']);
});
