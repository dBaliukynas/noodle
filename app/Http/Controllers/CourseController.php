<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\ForumThread;
use App\Models\ForumCategory;
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
    public function segmentsDelete($course_id, $segment_id)
    {
        $auth_user = Auth::user();
        if ($auth_user->role_id == 3) {
            return response(403);
        }

        $course_segment = CourseSegment::find($segment_id);
        $course_segment->delete();
        return response()->json($course_segment, 200);
    }

    public function index($id)
    {

        $auth_user = User::with('group')->with('team')->with('project')->with('ratings')->find(Auth::id());
        $project_members = User::where('project_id', $auth_user->project_id)->where('id', '!=', $auth_user->id)->with('group')->with('team')->with('project')->get();
        $forum_threads = ForumThread::with('category')->whereHas('category', function ($query) use ($id) {
            $query->where('title', 'like', 'Projects')->where('course_id', 'like', $id);
        })->get();
        if ($auth_user->courses->find($id) == null && $auth_user->role_id != 1) {
            return response()->json('You do not have permissions to access this page', 403);
        }
        $course = Course::find($id);
        $course_segments = CourseSegment::with('user')->where('course_id', $id)->get();
        $course_forum_category = ForumCategory::where('course_id', $id)->where('title', $course->name)->where('parent_id', null)->first();
        return view('course')
            ->with('auth_user', $auth_user)
            ->with('students', $course->users->where('role_id', 3)->values())
            ->with('professors', $course->users->where('role_id', 2)->values())
            ->with('forum_threads', $forum_threads)
            ->with('project_members', $project_members)
            ->with('project_member_count',  $this->countProjectMembers($project_members))
            ->with('course', $course)
            ->with('course_segments', $course_segments)
            ->with('course_forum_category', $course_forum_category);
    }
}
