<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use App\Models\ForumThread;
use App\Models\ForumThreadLike;
use Illuminate\Support\Facades\Auth;

class ForumThreadLikeController extends Controller
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

    public function likeForumThread($id)
    {
        $forum_thread = ForumThread::where('id', $id)->first();
        $likes = ForumThreadLike::where('user_id', Auth::user()->id)->where('forum_thread_id', $id)->first();

        if ($likes != null) {
            return response()->json(['message' => 'Cannot like same forum thread multiple times'], 409);
        }
        
        $likes = ForumThreadLike::create([
            'user_id' => Auth::user()->id,
            'forum_thread_id' => $id
        ]);

        $forum_thread->likes += 1;
        $forum_thread->save();

        return response()->json($likes, 200);
    }

    public function deleteLikeForumThread($id)
    {
        $forum_thread = ForumThread::where('id', $id)->first();
        $likes = ForumThreadLike::where('user_id', Auth::user()->id)->where('forum_thread_id', $id)->first();

        if ($likes == null) {
            return response()->json(['message' => 'This forum thread is not liked'], 404);
        }

        $likes->delete();
        $forum_thread->likes -= 1;
        $forum_thread->save();

        return response()->json($likes, 200);
    }
}
