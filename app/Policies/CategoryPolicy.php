<?php

namespace App\Policies;

use TeamTeaTime\Forum\Models\Category;

class CategoryPolicy
{
    public function createThreads($user, Category $category): bool
    {
        return $user->role_id == 1 || $user->role_id == 2 || $user->role_id == 3;
    }

    public function manageThreads($user, Category $category): bool
    {

        return $this->deleteThreads($user, $category) ||
            $this->restoreThreads($user, $category) ||
            $this->enableThreads($user, $category) ||
            $this->moveThreadsFrom($user, $category) ||
            $this->moveThreadsTo($user, $category) ||
            $this->lockThreads($user, $category) ||
            $this->pinThreads($user, $category);
    }

    public function deleteThreads($user, Category $category): bool
    {
        return $user->role_id == 1 || $user->role_id == 2;
    }

    public function restoreThreads($user, Category $category): bool
    {
        return $user->role_id == 1 || $user->role_id == 2;
    }

    public function enableThreads($user, Category $category): bool
    {
        return $user->role_id == 1 || $user->role_id == 2;
    }

    public function moveThreadsFrom($user, Category $category): bool
    {
        return $user->role_id == 1 || $user->role_id == 2;
    }

    public function moveThreadsTo($user, Category $category): bool
    {
        return $user->role_id == 1 || $user->role_id == 2;
    }

    public function lockThreads($user, Category $category): bool
    {
        return $user->role_id == 1 || $user->role_id == 2;
    }

    public function pinThreads($user, Category $category): bool
    {
        return $user->role_id == 1 || $user->role_id == 2;
    }

    public function markThreadsAsRead($user, Category $category): bool
    {
        return $user->role_id == 1 || $user->role_id == 2 || $user->role_id == 3;
    }

    public function view($user, Category $category): bool
    {
        return $user->role_id == 1 || $user->role_id == 2;
    }

    public function delete($user, Category $category): bool
    {
        return $user->role_id == 1 || $user->role_id == 2;
    }
}
