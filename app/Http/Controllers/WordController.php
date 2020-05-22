<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class WordController extends Controller
{
    public function learned(User $user)
    {
        $answers = $user->answers()->paginate(20);

        return view('word.learned', compact(['user', 'answers']));
    }
}
