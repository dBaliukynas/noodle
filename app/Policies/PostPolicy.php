<?php

namespace App\Policies;

use TeamTeaTime\Forum\Models\Post;

class PostPolicy
{
    public function edit($user, Post $post): bool
    {
        return $user->getKey() === $post->author_id || ($user->role_id == 1 || $user->role_id == 2);
    }

    public function delete($user, Post $post): bool
    {
        return $user->getKey() === $post->author_id || ($user->role_id == 1 || $user->role_id == 2);
    }

    public function restore($user, Post $post): bool
    {
        return $user->getKey() === $post->author_id || ($user->role_id == 1 || $user->role_id == 2);
    }
}
