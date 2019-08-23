<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class XHubSignatureMiddleware
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
        if (! $request->hasHeader('X-Hub-Signature')) {
            return response('Missing X-Hub-Signature header. Did you configure secret token in hook settings?', 422);
        }

        if ($request->header('X-Hub-Signature') !== 'sha1=' . hash_hmac('sha1', $request->getContent(), env('X_HUB_SIGNATURE'), false )) {
            return response(' - Incorrect X-Hub-Signature.', 401);
        }

        return $next($request);
    }
}
