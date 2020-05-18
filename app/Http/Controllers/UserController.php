<?php

namespace App\Http\Controllers;

use App\User;
use App\Activity;
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
}
