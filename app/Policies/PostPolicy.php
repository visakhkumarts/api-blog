<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id; // Only the post owner can update
    }

    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id; // Only the post owner can update
    }
}

