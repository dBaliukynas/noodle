<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Helpers\AuthHelper;

class ProfessorsController extends Controller
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

    public function uploadProfessors(Request $request)
    {
        if (Auth::user()->role_id != 1) {
            return response()->json(['message' => 'You do not have permissions'], 403);
        }

        $password = AuthHelper::random_password(10);
        $data = $request->json()->all();
        $professor = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'password' => Hash::make($password),
            'role_id' => 2,
        ]);

        $professor->password = $password;
        Mail::to($data['email'])->send(new WelcomeMail($professor));

        return response(200);
    }

    public function downloadProfessorsList()
    {
        $auth_user = Auth::user();
        $professors = User::where('role_id', 2)->get();
        $download = json_encode($professors);
        $filename = 'professorslist.json';

        if ($auth_user->role_id == 3) {
            return response(403);
        }
        
        return response()->streamDownload(function () use ($download) {
            echo $download;
        }, $filename);
    }

    public function delete($id)
    {
        $auth_user = Auth::user();

        if ($auth_user->role_id == 3) {
            return response()->json(['message' => 'You do not have permissions'], 403);
        }

        $professor = User::find($id);
        $professor->delete();
        return response(200);
    }


    public function index()
    {
        $auth_user = Auth::user();
        $professors = User::where('role_id', 2)->get();

        return view('professors')->with('professors', $professors)->with('auth_user', $auth_user);
    }
}
