<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('author can update post', function () {
    $user = User::factory()->create(['role' => 'author']);
    $post = Post::factory()->create();

    expect($user->can('update', $post))->toBeTrue();
});

test('guest cannot create post', function () {
    $user = User::factory()->create(['role' => 'guest']);

    expect($user->can('create', Post::class))->toBeFalse();
});
