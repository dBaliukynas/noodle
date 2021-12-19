<?php

namespace App\Policies;

use TeamTeaTime\Forum\Models\Thread;

class ThreadPolicy
{
    public function view($user, Thread $thread): bool
    {
        return $user->role_id == 1 || $user->role_id == 2;
    }

    public function deletePosts($user, Thread $thread): bool
    {
        return $user->role_id == 1 || $user->role_id == 2;
    }

    public function restorePosts($user, Thread $thread): bool
    {
        return $user->role_id == 1 || $user->role_id == 2;
    }

    public function rename($user, Thread $thread): bool
    {
        return $user->getKey() === $thread->author_id || ($user->role_id == 1 || $user->role_id == 2);
    }

    public function reply($user, Thread $thread): bool
    {
        return !$thread->locked || ($user->role_id == 1 || $user->role_id == 2);
    }

    public function delete($user, Thread $thread): bool
    {
        return $user->getKey() === $thread->author_id || ($user->role_id == 1 || $user->role_id == 2);
    }

    public function restore($user, Thread $thread): bool
    {
        return $user->getKey() === $thread->author_id || ($user->role_id == 1 || $user->role_id == 2);
    }
}
