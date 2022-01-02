<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;
use App\Helpers\StringHelper;
use Illuminate\Support\Facades\Auth;

class TeamsController extends Controller
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

    public function teamsPost(Request $request)
    {

        $data = $request->json()->all();
        if (StringHelper::is_null_or_empty_string($data['name'])) {
            return response()->json(['message' => 'Team name cannot be null or empty string or have more than 25 characters'], 400);
        }

        $team = Team::where('user_id', Auth::user()->id)->get();
        if (Auth::user()->role_id == 3 && count($team) >= 1) {
            return response()->json(['message' => 'You can only create 1 team'], 403);
        }

        $team = Team::create([
            'name' => $data['name'],
            'user_id' => Auth::user()->id,
        ]);
        if (Auth::user()->role_id == 3) {
            $user = User::find($team->user_id);
            $user->team_id = $team['id'];
            $user->save();
        }

        return response()->json($team, 200);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    private function findTeamUsersCount($teams)
    {
        if (count($teams) != 0) {
            foreach ($teams as &$team) {
                $team_users_count = User::where('team_id', $team->id)->get()->count();
                $all_team_users_count[] = $team_users_count;
            }
            return $all_team_users_count;
        }
    }

    public function index()
    {
        $teams = Team::all();

        return view('teams')
            ->with('teams', $teams)
            ->with('all_team_users_count', $this->findTeamUsersCount($teams));
    }
}
