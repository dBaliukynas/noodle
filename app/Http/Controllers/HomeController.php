<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Helpers\StringHelper;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
        $auth_user = Auth::user();

        if ($auth_user->role_id != 1) {
            $courses = $auth_user->courses;
        } else {
            $courses = Course::all();
        }

        return view('home')->with('auth_user', $auth_user)->with('courses', $courses);
    }
}
