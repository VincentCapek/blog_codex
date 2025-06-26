<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function create(User $user): bool
    {
        return in_array($user->role, ['author', 'admin']);
    }

    public function update(User $user, Post $post): bool
    {
        return in_array($user->role, ['author', 'admin']);
    }
}
