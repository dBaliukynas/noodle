<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ForumThread;
use App\Models\ForumCategory;

class ProjectController extends Controller
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

    private function countProjectMembers($auth_user, $project_members)
    {
        $project_member_count = 0;
        foreach ($project_members as &$project_member) {
            $project_member_count += 1;
        }
        return $project_member_count;
    }

    public function index()
    {
        $auth_user = User::with('group')->with('team')->with('project')->with('ratings')->find(Auth::id());
        $project_members = User::where('project_id', $auth_user->project_id)->where('id', '!=', $auth_user->id)->with('group')->with('team')->with('project')->get();
        $forum_threads = ForumThread::with('category')->whereHas('category', function ($query) {
            $query->where('title', 'like', 'Projects');
        })->get();


        return view('project')->with('auth_user', $auth_user)
            ->with('forum_threads', $forum_threads)
            ->with('project_members', $project_members)
            ->with('project_member_count',  $this->countProjectMembers($auth_user, $project_members));
    }
}
