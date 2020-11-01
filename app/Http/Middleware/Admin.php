<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($userId = Auth::id()) {
            $user = User::query()->where('id', '=', $userId)->first();

            if ($user !== null && $user->isAdmin()) {
                return $next($request);
            }
        }

        return redirect(route('welcome'));
    }
}
