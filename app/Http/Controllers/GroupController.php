<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use App\Models\ForumThread;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
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
    public function delete($id)
    {
        $users = User::where('group_id', $id)->get();
        $auth_user = Auth::user();
        if ($auth_user->role_id == 1 || $auth_user->role_id == 2) {
            foreach ($users as &$user) {
                $user->group_id = null;
                $user->save();
            }
            $group = Group::find($id);
            $group->delete();
        } else {
            return response(403);
        }
    }

    public function manageStudents($id, Request $request)
    {
        $auth_user = Auth::user();

        $data = $request->json()->all();
        if ($auth_user->role_id == 1 || $auth_user->role_id == 2) {
            foreach ($data as &$student) {
                if ($student['action'] == 'add') {
                    $user = User::find($student['studentId']);
                    $user->group_id = $id;
                    $user->save();
                } else if ($student['action'] == 'delete') {
                    $user = User::find($student['studentId']);
                    $user->group_id = null;
                    $user->save();
                }
            }
        } else {
            return response(403);
        }
    }

    public function downloadUsersList($id)
    {
        $auth_user = Auth::user();
        $user = User::where('group_id', $id)->with('group')->with('team')->with('project')->get();
        $download = json_encode($user);
        $filename = 'groupuserslist.json';
        if ($auth_user->role_id == 1 || $auth_user->role_id == 2) {
            return response()->streamDownload(function () use ($download) {
                echo $download;
            }, $filename);
        } else {
            return response(403);
        }
    }

    public function index($id)
    {
        $auth_user = Auth::user();
        $group = Group::with('user')->find($id);
        $all_students = User::where('role_id', 3)->with('group')->with('team')->with('project')->get();
        $group_users = User::where('group_id', $id)->with('group')->with('team')->with('project')->get();
        $group_students = User::where('group_id', $id)->where('role_id', 3)->with('group')->with('team')->with('project')->get();
        $group_professors = User::where('group_id', $id)->where('role_id', 2)->with('group')->with('team')->with('project')->get();
        $group_admins = User::where('group_id', $id)->where('role_id', 1)->with('group')->with('team')->with('project')->get();

        $forum_threads = ForumThread::with('category')->whereHas('category', function ($query) {
            $query->where('title', 'like', 'Projects');
        })->get();

        return view('group')
            ->with('group_users', $group_users)
            ->with('group_students', $group_students)
            ->with('all_students', $all_students)
            ->with('group', $group)
            ->with('auth_user', $auth_user)
            ->with('group_admins', $group_admins)
            ->with('group_professors', $group_professors)
            ->with('forum_threads', $forum_threads);
    }
}
