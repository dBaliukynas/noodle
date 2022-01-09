<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
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
        $auth_user = Auth::user();

        if ($auth_user->role_id == 3) {
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
