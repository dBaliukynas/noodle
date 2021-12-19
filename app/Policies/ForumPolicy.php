<?php

namespace App\Policies;

class ForumPolicy
{
    public function createCategories($user): bool
    {
        return $user->role_id == 1 || $user->role_id == 2;
    }

    public function manageCategories($user): bool
    {
        return $this->moveCategories($user) ||
            $this->renameCategories($user);
    }

    public function moveCategories($user): bool
    {
        return $user->role_id == 1 || $user->role_id == 2;
    }

    public function renameCategories($user): bool
    {
        return $user->role_id == 1 || $user->role_id == 2;
    }

    public function markThreadsAsRead($user): bool
    {
        return $user->role_id == 1 || $user->role_id == 2 || $user->role_id == 3;
    }

    public function viewTrashedThreads($user): bool
    {
        return $user->role_id == 1 || $user->role_id == 2;
    }

    public function viewTrashedPosts($user): bool
    {
        return $user->role_id == 1 || $user->role_id == 2;
    }
}
