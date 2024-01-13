<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    public function handle($request, Closure $next)
    {
        Visitor::create([
            'ip_address'   => $request->ip(),
            'user_agent'   => $request->header('User-Agent'),
            'request_path' => $request->path(),
        ]);

        return $next($request);
    }
}
