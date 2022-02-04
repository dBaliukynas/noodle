<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use \Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Helpers\AuthHelper;
use Illuminate\Support\Facades\Auth;

class FileUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function fileUploadPost(Request $request)
    {
        $auth_user = Auth::user();

        if ($auth_user->role_id == 3) {
            return response(403);
        }

        $request->validate([
            'file' => 'required|file|mimes:csv,xls,ods,json|max:2000',
        ]);

        $content = $request->file->get();
        $students = json_decode($content);

        foreach ($students as &$student) {
            $student->password = AuthHelper::random_password(10);
        }

        try {
            User::insert(array_map(fn ($student) => $this->convertStudentToRecord($student), $students));
        } catch (QueryException $e) {
            return response()->json(['message' => 'Students cannot have the same email'], 409);
        }
        foreach ($students as &$student) {
            $student->name = $student->firstname;
            Mail::to($student->email)->queue(new WelcomeMail($student));
        }
        return response(200);
    }
    public function courseUsersPost(Request $request, $id)
    {
        $auth_user = Auth::user();

        if ($auth_user->role_id == 3) {
            return response(403);
        }

        $request->validate([
            'file' => 'required|file|mimes:csv,xls,ods,json|max:2000',
        ]);

        $content = $request->file->get();
        $users = json_decode($content);
        foreach ($users as &$user) {
            $user_2 = User::where('email', $user->email)->first();
            if ($user_2 == null) {
                $this->fileUploadPost($request);
                $user_2 = User::where('email', $user->email)->first();
            }

            if ($user_2->courses->find($id) != null) {
                return response()->json(['message' => 'Student already exists in this course'], 403);
            } else {
                $user_2->save();
                $user_2->courses()->attach($id);
            }
        }
    }

    private function convertStudentToRecord($student)
    {
        return ([
            'name' => $student->firstname,
            'surname' => $student->lastname,
            'email' => $student->email,
            'password' => Hash::make($student->password),
            'role_id' => 3,
        ]);
    }
}
