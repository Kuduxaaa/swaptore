<?php

namespace App\Http\Middleware;

use App\Models\LoginLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) 
        {
            if (Auth::user()->role == 2)
            {
                return $next($request);
            }
            else
            {
                LoginLog::create([
                    'status' => 'failed',
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->header('User-Agent'),
                    'comment' => 'User with id ' . strval(Auth::user()->id) . ' tried to login to admin panel'
                ]);
            }
        }



        return abort(403);
    }
}
