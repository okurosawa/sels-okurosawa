<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function list()
    {
        $users = User::where('admin_flag', true)
            ->orderBy('deleted_at', 'asc')->paginate(10);

        return view('admin.list', compact('users'));
    }

    public function add()
    {
        return view('admin.add');
    }

    public function edit(User $user)
    {
        return view('admin.edit', compact('user'));
    }

    public function update(AdminRequest $request, User $user)
    {
        $user->updateProfile($request);

        return redirect()->route('admin.list')
            ->with('my_status', __("Succeeded to update profile of ID No {$user->id}."));
    }

    public function delete(User $user)
    {
        $user->delete();

        return back()
            ->with('my_status', __("Succeeded to delete {$user->first_name}{$user->last_name}"));
    }
}
