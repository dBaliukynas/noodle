<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Course;
use App\Models\ForumThreadLike;
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
        View::share('courses', Course::all());
        view()->composer(['forum::thread.partials.list', 'forum::thread.show'], function ($view)
        {
            $forum_thread_like_users = ForumThreadLike::orderBy('id', 'asc')->with('user')->get(['forum_thread_id', 'user_id']);

            $view->with('forum_thread_like_users', $forum_thread_like_users);
        });
    }
}
