<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLessonUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $lesson = $request->route()->parameter('lesson');

        if ($lesson->user_id != Auth::id()) {
            abort(404);
        }

        return $next($request);
    }
}
