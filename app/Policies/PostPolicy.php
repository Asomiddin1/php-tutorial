<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;


class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    public function edit(User $user, Post $post): bool
    {
       // If the relation is loaded, compare model instances; otherwise fall back to the foreign key.
       return ($post->user && $post->user->is($user)) || $post->user_id === $user->id;
    }
    public function delete(User $user, Post $post): bool
    {
        // Same logic as edit: prefer model comparison if available, fallback to user_id.
        return ($post->user && $post->user->is($user)) || $post->user_id === $user->id;
    }
}
