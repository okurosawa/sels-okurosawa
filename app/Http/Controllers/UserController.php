<?php

namespace App\Http\Controllers;

use App\User;
use App\Activity;
use App\Relationship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::select(['id', 'first_name', 'last_name', 'avatar_path'])
            ->where('id', Auth::id())
            ->withCount(['lessons', 'answers'])
            ->first();
        $activities = Activity::orderBy('updated_at', 'desc')->get();
        return view('user.home', compact('user', 'activities'));
    }

    public function list()
    {
        $users = User::select(['id', 'first_name', 'last_name', 'avatar_path'])->paginate(10);

        return view('user.list', compact('users'));
    }

    public function follow(User $user)
    {
        $createdRelationship = Relationship::create([
            'follower_id' => Auth::id(),
            'following_id' => $user->id
        ]);

        $activity = new Activity();
        $activity->logActivity(Auth::id(), $createdRelationship->id, 'App\Relationship');

        return back();
    }

    public function unfollow(User $user)
    {
        Auth::user()->following()->detach($user);
        return back();
    }

    public function profile(User $user)
    {
        return view('user.profile', compact('user'));
    }
}
