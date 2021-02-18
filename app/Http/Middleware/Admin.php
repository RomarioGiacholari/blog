<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        if ($userId = Auth::id()) {
            /* @var $user User*/
            $user = User::query()->where('id', '=', $userId)->first();

            if ($user !== null && $user->isAdministrator()) {
                return $next($request);
            }
        }

        return redirect(route('welcome'));
    }
}
