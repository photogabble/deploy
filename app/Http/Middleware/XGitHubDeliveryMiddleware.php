<?php

namespace App\Http\Middleware;

use App\Deployment;
use Closure;
use Illuminate\Http\Request;

class XGitHubDeliveryMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (! $request->hasHeader('X-GitHub-Delivery')) {
            return response('Missing X-GitHub-Delivery header.', 422);
        }

        if (Deployment::whereDeliveryId($request->header('X-GitHub-Delivery'))->exists()) {
            return response('Delivery already processed.', 422);
        }

        return $next($request);
    }
}
