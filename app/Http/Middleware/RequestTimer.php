<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RequestTimer
{
    /**
     * Handle an incoming request.
     * @param Request $request
     * @param  Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $timer = microtime(true);

        /** @var JsonResponse  $response */
        $response = $next($request);

        $content = json_decode($response->getContent(), true);
        $content['time'] = (microtime(true) - $timer) . ' сек.';
        $response->setContent(json_encode($content));

        return $response;
    }
}
