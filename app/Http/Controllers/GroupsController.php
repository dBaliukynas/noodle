<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;
use App\Helpers\StringHelper;
use Illuminate\Support\Facades\Auth;

class GroupsController extends Controller
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

    public function groupsPost(Request $request)
    {
        $auth_user = Auth::user();
        if ($auth_user->role_id == 1 || $auth_user->role_id == 2) {
            $data = $request->json()->all();
            if (StringHelper::is_null_or_empty_string($data['name'])) {
                return response()->json(['message' => 'Group name cannot be null or empty string or have more than 25 characters'], 400);
            }
            $group = Group::create([
                'name' => $data['name'],
                'user_id' => Auth::user()->id,
            ]);
            if (Auth::user()->role_id == 3) {
                $user = User::find($group->user_id);
                $user->group_id = $group['id'];
                $user->save();
            }


            return response()->json($group, 200);
        } else {
            return response(403);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    private function findGroupUsersCount($groups)
    {
        if (count($groups) != 0) {
            foreach ($groups as &$group) {
                $group_users_count = User::where('group_id', $group->id)->get()->count();
                $all_group_users_count[] = $group_users_count;
            }
            return $all_group_users_count;
        }
    }
    public function index()
    {
        $groups = Group::all();
        $auth_user = Auth::user();

        return view('groups')
            ->with('groups', $groups)
            ->with('auth_user', $auth_user, 'group_users_count')
            ->with('all_group_users_count', $this->findGroupUsersCount($groups));
    }
}
