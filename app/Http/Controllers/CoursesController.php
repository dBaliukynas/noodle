<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\ForumCategory;
use App\Helpers\StringHelper;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
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
    public function coursesPost(Request $request)
    {
        $forum_category_seq = ForumCategory::all()->max('_rgt');
        $auth_user = Auth::user();

        if ($auth_user->role_id != 1) {
            return response(403);
        }

        $data = $request->json()->all();
        if (StringHelper::is_null_or_empty_string($data['name'], 25)) {
            return response()->json(['message' => 'Course name cannot be null or empty string or have more than 25 characters'], 400);
        } else if (StringHelper::is_null_or_empty_string($data['description'], 50)) {
            return response()->json(['message' => 'Description cannot be null or empty string or have more than 50 characters'], 400);
        }

        $course = Course::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'user_id' => Auth::user()->id,
            'image_name' => $data['image_name'],
        ]);
        $forum_category = ForumCategory::create(
            [
                'title' => $data['name'],
                'description' => $data['description'],
                'accepts_threads' => true,
                'is_private' => false,
                'course_id' => $course->id,
                '_lft' => $forum_category_seq += 1,
                '_rgt' => $forum_category_seq += 1,
            ]
        );

        $course_forum_categories = ([

            [
                'title' => 'Projects',
                'description' => 'In this category, both students and professors offer the projects for ' . $data['name'] . ' course.',
                'accepts_threads' => true,
                'is_private' => false,
                'course_id' => $course->id,
                'parent_id' => $forum_category->id,
                'color' => '#FFC107',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                '_lft' => $forum_category_seq += 1,
                '_rgt' => $forum_category_seq += 1,
            ],
            [
                'title' => 'Questions & Answers',
                'description' => 'In this category, students can ask any questions related about ' . $data['name'] . ' course.',
                'accepts_threads' => true,
                'is_private' => false,
                'course_id' => $course->id,
                'parent_id' => $forum_category->id,
                'color' => '#673AB7',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                '_lft' => $forum_category_seq += 1,
                '_rgt' => $forum_category_seq += 1,
            ],
            [
                'title' => 'News / Information',
                'description' => 'In this category, professors may post news and / or information about ' . $data['name'] . ' course.',
                'accepts_threads' => true,
                'is_private' => false,
                'course_id' => $course->id,
                'parent_id' => $forum_category->id,
                'color' => '#4CAF50',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                '_lft' => $forum_category_seq += 1,
                '_rgt' => $forum_category_seq += 1,
            ],
            [
                'title' => 'Feedback',
                'description' => 'In this category, students can write feedback about ' . $data['name'] . ' course.',
                'accepts_threads' => true,
                'is_private' => false,
                'course_id' => $course->id,
                'parent_id' => $forum_category->id,
                'color' => '#9C27B0',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                '_lft' => $forum_category_seq += 1,
                '_rgt' => $forum_category_seq += 1,
            ]
        ]


        );
        ForumCategory::insert($course_forum_categories);

        return response()->json($course, 200);
    }
    public function imageUploadPost(Request $request)
    {
        $auth_user = Auth::user();

        if ($auth_user->role_id == 3) {
            return response(403);
        }
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);
        $image = $request->file('image');
        $destinationPath = 'img/courses/';
        $image_name = $image->getClientOriginalName();
        if (file_exists("img/courses/" . $image_name)) {
            $image_name = pathinfo($image_name, PATHINFO_FILENAME) . '.' . date("YmdHis") . '.' . $image->getClientOriginalExtension();
        }
        $image->move($destinationPath, $image_name);

        return response()->json(['image_name' => '/img/courses/' . $image_name]);
    }
}
