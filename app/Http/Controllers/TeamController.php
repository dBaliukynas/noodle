<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Team;
use App\Models\Rating;
use App\Models\ForumThread;
use Illuminate\Support\Facades\Auth;


class TeamController extends Controller
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
        $team = Team::find($id);
        $auth_user = Auth::user();
        $users = User::where('team_id', $id)->get();
        if ($auth_user->role_id == 1 || $auth_user->role_id == 2 || $auth_user->id == $team->user_id) {
            foreach ($users as &$user) {
                $user->team_id = null;
                $user->save();
            }
            $team = Team::find($id);
            $team->delete();
        } else {
            return response(403);
        }
    }

    public function rateStudent(Request $request, $team_id)
    {
        $data = $request->json()->all();

        $auth_user = Auth::user();

        $ratings = Rating::where('user_id', $data['studentId'])->where('rated_by', $auth_user->id)->first();

        if ($ratings == null && ($team_id == $auth_user->team_id) || $auth_user->role_id == 1 || $auth_user->role_id == 2) {
            if ($data['grade'] == 0) {
                return response()->json(['message' => 'Choose a star from 1 to 10'], 403);
            } else if ($data['comment'] == null) {
                return response()->json(['message' => 'Comment cannot be empty'], 403);
            } else if (($auth_user->role_id != 1 && $auth_user->id == $data['studentId'])) {
                return response()->json(['message' => 'You cannot rate yourself'], 403);
            }
            $rating = Rating::create([
                'user_id' => $data['studentId'],
                'grade' => $data['grade'],
                'comment' => $data['comment'],
                'rated_by' => $auth_user->id
            ]);
            return response()->json($rating, 200);
        } else {
            if ($auth_user->role_id != 1) {
                return response()->json(['message' => 'You can rate same student only once'], 403);
            } else {
                $rating = Rating::create([
                    'user_id' => $data['studentId'],
                    'grade' => $data['grade'],
                    'comment' => $data['comment'],
                    'rated_by' => $auth_user->id
                ]);
                return response()->json($rating, 200);
            }
        }
    }

    public function manageStudents($id, Request $request)
    {
        $team = Team::with('user')->find($id);
        $auth_user = Auth::user();


        $data = $request->json()->all();

        foreach ($data as &$student) {
            if ($student['action'] == 'join') {
                $user = User::find($student['studentId']);
                $user->team_id = $id;
                $user->save();
            }
            if ($auth_user->role_id == 3 && $auth_user->role_id != $team->user_id) {
                if ($student['action'] == 'add') {
                    $user = User::find($student['studentId']);
                    $user->team_id = $id;
                    $user->save();
                } else if ($student['action'] == 'delete') {
                    $user = User::find($student['studentId']);
                    $user->team_id = null;
                    $user->save();
                }
            } else {
                return response(403);
            }
        }
    }

    public function downloadUsersList($id)
    {
        $team = Team::with('user')->find($id);
        $auth_user = Auth::user();
        $user = User::where('team_id', $id)->with('group')->with('team')->with('project')->with('ratings')->get();
        $download = json_encode($user);
        $filename = 'teamuserslist.json';
        if ($auth_user->role_id == 3 && $auth_user->role_id != $team->user_id) {
            return response(403);
        }
        return response()->streamDownload(function () use ($download) {
            echo $download;
        }, $filename);
    }

    public function index($id)
    {
        $team = Team::with('user')->find($id);
        $all_students = User::where('role_id', 3)->with('group')->with('team')->with('project')->get();
        $team_users = User::where('team_id', $id)->with('group')->with('team')->with('project')->with('ratings')->get();
        $team_students = User::where('team_id', $id)->where('role_id', 3)->with('group')->with('team')->with('project')->with('ratings')->get();
        $team_professors = User::where('team_id', $id)->where('role_id', 2)->with('group')->with('team')->with('project')->with('ratings')->get();
        $team_admins = User::where('team_id', $id)->where('role_id', 1)->with('group')->with('team')->with('project')->with('ratings')->get();
        $auth_user = Auth::user();

        $forum_threads = ForumThread::with('category')->whereHas('category', function ($query) {
            $query->where('title', 'like', 'Projects');
        })->get();



        $ratings = Rating::where('rated_by', $auth_user->id)->get();

        return view('team')
            ->with('team_users', $team_users)
            ->with('team_students', $team_students)
            ->with('team_professors', $team_professors)
            ->with('team_admins', $team_admins)
            ->with('all_students', $all_students)
            ->with('team', $team)
            ->with('auth_user', $auth_user)
            ->with('ratings', $ratings)
            ->with('forum_threads', $forum_threads);
    }
}
