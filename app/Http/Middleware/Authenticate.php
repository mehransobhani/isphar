<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
//    protected function redirectTo(Request $request): ?string
//    {
//        return $request->expectsJson() ? null : route('login');
//    }


    protected function unauthenticated($request, array $guards)
    {
        if($request->expectsJson()) {
            return null;
         }
        if($request->is('api/*'))
        {
            response()->json(['message' => 'Unauthenticated.'], 401)->send();
            exit;
        }
        redirect()->guest(route('login'))->send();

    }

}
