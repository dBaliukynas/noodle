<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\ForumThread;
use App\Helpers\StringHelper;
use App\Models\CourseSegment;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
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

    private function countProjectMembers($project_members)
    {
        $project_member_count = 0;
        foreach ($project_members as &$project_member) {
            $project_member_count += 1;
        }
        return $project_member_count;
    }
    public function segmentsPost(Request $request, $id)
    {
        $auth_user = Auth::user();
        if ($auth_user->role_id == 3) {
            return response(403);
        }
        $data = $request->json()->all();

        if (StringHelper::is_null_or_empty_string($data['newSegmentName'], 25)) {
            return response()->json(['message' => 'Segment name cannot be null or empty string or have more than 25 characters'], 400);
        }

        $course_segment = CourseSegment::create([
            'name' => $data['newSegmentName'],
            'content' => $data['newSegmentContent'],
            'course_id' => Course::find($id)->id,
            'user_id' => Auth::user()->id,
        ]);


        return response()->json($course_segment, 200);
    }
    public function index($id)
    {
        $auth_user = User::with('group')->with('team')->with('project')->with('ratings')->find(Auth::id());
        $students = User::where('role_id', 3)->with('group')->with('team')->with('project')->get();
        $professors = User::where('role_id', 2)->get();
        $project_members = User::where('project_id', $auth_user->project_id)->where('id', '!=', $auth_user->id)->with('group')->with('team')->with('project')->get();
        $forum_threads = ForumThread::with('category')->whereHas('category', function ($query) {
            $query->where('title', 'like', 'Projects');
        })->get();
        $course = Course::find($id);
        $course_segments = CourseSegment::with('user')->get();
        return view('course')
            ->with('auth_user', $auth_user)
            ->with('students', $students)
            ->with('professors', $professors)
            ->with('forum_threads', $forum_threads)
            ->with('project_members', $project_members)
            ->with('project_member_count',  $this->countProjectMembers($project_members))
            ->with('course', $course)
            ->with('course_segments', $course_segments);
    }
}
