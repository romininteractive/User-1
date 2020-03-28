<?php

namespace Modules\User\Http\Middleware;

class NoCacheMiddleware {
    public function handle($request, \Closure $next)
    {
        $response = $next($request);
        
        try {
            return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
                ->header('Pragma','no-cache')
                ->header('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
        }
        catch(\Error $e){
            // Happened when exporting the table.

            return $response;
        }
    }
}