<?php

use Closure as ClosureAlias;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequireJsonResponse
{
    /**
     * Handle an incoming request.
     *
     * @param ClosureAlias(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $acceptHeader = $request->header('Accept', '');

        // Block browser requests that explicitly request HTML
        // Browsers typically send: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8
        if (str_contains($acceptHeader, 'text/html') || str_contains($acceptHeader, 'application/xhtml+xml')) {
            abort(403, 'Access denied.');
        }

        // Allow API requests:
        // - Requests with application/json in Accept header
        // - Requests with */* (wildcard) or empty Accept header (common in API clients)
        // - Requests without Accept header (Postman default sometimes)
        return $next($request);
    }
}
