<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use App\Models\ForumThread;


class RoomController extends Controller
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

    public function deleteAssignedProject($id, $project_id)
    {
        $auth_user = Auth::user();

        if ($auth_user->role_id == 3) {
            return response(403);
        }

        $student = User::find($id);
        $student->project_id = null;
        $student->save();
        return response()->json($student, 200);
    }

    public function assignProject($id, $project_id)
    {
        $auth_user = Auth::user();

        if ($auth_user->role_id == 3) {
            return response(403);
        }
        $student = User::find($id);
        $student->project_id = $project_id;
        $student->save();
        return response()->json($student, 200);
    }

    public function delete($id)
    {
        $auth_user = Auth::user();

        if ($auth_user->role_id == 3) {
            return response(403);
        }

        $student = User::find($id);
        $student->delete();
        return response(200);
    }

    public function downloadStudentsList()
    {
        $auth_user = User::with('group')->with('team')->with('project')->with('ratings')->find(Auth::id());
        $students = User::where('role_id', 3)->get();
        $download = json_encode($students);
        $filename = 'studentslist.json';
        if ($auth_user->role_id == 3) {
            return response(403);
        }
        return response()->streamDownload(function () use ($download) {
            echo $download;
        }, $filename);
    }
}
