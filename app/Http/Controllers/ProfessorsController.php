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
        $password = AuthHelper::random_password(10);
        if (Auth::user()->role_id == 1) {
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
        } else {
            return response()->json(['message' => 'You do not have permissions'], 403);
        }


        return response(200);
    }

    public function downloadProfessorsList()
    {
        $auth_user = Auth::user();
        $professors = User::where('role_id', 2)->get();
        $download = json_encode($professors);
        $filename = 'professorslist.json';
        if ($auth_user->role_id == 1 || $auth_user->role_id == 2) {
            return response()->streamDownload(function () use ($download) {
                echo $download;
            }, $filename);
        } else {
            return response(403);
        }
    }

    public function delete($id)
    {
        $auth_user = Auth::user();
        if ($auth_user->role_id == 1 || $auth_user->role_id == 2) {
            $professor = User::find($id);
            $professor->delete();
            return response(200);
        } else {
            return response()->json(['message' => 'You do not have permissions'], 403);
        }
    }

    public function index()
    {
        $auth_user = Auth::user();
        $professors = User::where('role_id', 2)->get();

        return view('professors')->with('professors', $professors)->with('auth_user', $auth_user);
    }
}
