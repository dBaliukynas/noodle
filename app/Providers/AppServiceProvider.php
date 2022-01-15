<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Course;
use App\Models\ForumThreadLike;
use App\Models\ForumPost;
use App\Models\User;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            if ($view->getName() != 'welcome' && $view->getName() != 'auth.login' && $view->getName() != 'vendor.forum.master') {
                $view->with('courses', Course::all());
            }
        });
        view()->composer(['forum::thread.partials.list', 'forum::thread.show', 'forum::thread.recent'], function ($view) {
            $forum_thread_like_users = ForumThreadLike::orderBy('id', 'desc')->with('user')->has('user')->get(['forum_thread_id', 'user_id']);
            $forum_thread_reply_users = ForumPost::with('user')->with('thread')->has('user')->has('thread')->groupBy(['thread_id', 'author_id'])->get(['thread_id', 'author_id']);

            $view->with('forum_thread_like_users', $forum_thread_like_users)->with('forum_thread_reply_users', $forum_thread_reply_users);
        });
    }
}
