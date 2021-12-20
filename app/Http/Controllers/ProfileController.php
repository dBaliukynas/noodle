<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Rating;
use App\Models\ForumThread;
use App\Models\ForumThreadLike;
use App\Models\ForumCategory;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $auth_user = User::with('group')->with('team')->with('project')->with('ratings')->find(Auth::id());
        $ratings = Rating::with('user')->where('user_id', $auth_user->id)->get();
        $likes = ForumThreadLike::where('user_id', Auth::user()->id)->with('forum_thread')->get();
        $forum_categories = ForumCategory::all();
        $index = 0;
        foreach ($forum_categories as &$forum_category) {
            if ($forum_category->id == $likes[$index]->forum_thread->category_id) {
                $forum_categories_liked = $forum_category;
            }
            $index++;
        }

        $grade_total = 0;
        $average_grade = 0;
        $grades_count = 0;

        if (count($ratings) != 0) {
            foreach ($ratings as &$rating) {

                $grade_total += $rating->grade;
                $grades_count++;
            }
            $average_grade = round($grade_total / $grades_count, 3);
        }

        return view('profile')
            ->with('auth_user', $auth_user)
            ->with('ratings', $ratings)
            ->with('average_grade', $average_grade)
            ->with('likes', $likes)
            ->with('forum_categories_liked', $forum_categories_liked);
    }
}
