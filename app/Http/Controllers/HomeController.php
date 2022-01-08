<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
    public function imageUpload()
    {
        return view('/home');
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
        $destinationPath = 'img/';
        $image_name = $image->getClientOriginalName();
        if (file_exists("img/" . $image_name)) {
            $image_name = pathinfo($image_name, PATHINFO_FILENAME) . '.' . date("YmdHis") . '.' . $image->getClientOriginalExtension();
        }
        $image->move($destinationPath, $image_name);
    }

    public function index()
    {
        $auth_user = Auth::user();
        return view('home')->with('auth_user', $auth_user);
    }
}
