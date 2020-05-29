<?php

namespace App\Http\Controllers;

use App\User;
use App\Activity;
use App\Relationship;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function follower(User $user)
    {
        $followers = $user->followers()->paginate(10);
        return view('user.follower', compact('followers', 'user'));
    }

    public function following(User $user)
    {
        $following = $user->following()->paginate(10);
        return view('user.following', compact('following', 'user'));
    }

    public function edit()
    {
        return view('user.edit', ['user' => Auth::user()]);
    }

    public function update(UserRequest $request)
    {
        if (Hash::check($request->current_password, Auth::user()->password)) {
            Auth::user()->updateProfile($request);

            return back()->with('succeeded', __("Succeeded to update your profile."));
        }

        return back()->with('error', __("Your current password is wrong."))->withInput();
    }
}
