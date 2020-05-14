<?php
namespace App\Http\Middleware;
use Closure;
class Cors
{


public function handle($request, Closure $next)
{
    $allowedDomains = array("https://www.ebaaba.xyz");
    $origin = $request->server('HTTP_ORIGIN');
    if(in_array($origin, $allowedDomains)){
        //Intercepts OPTIONS requests
        if($request->isMethod('OPTIONS')) {
            $response = response('', 200);
        } else {
            // Pass the request to the next middleware
            $response = $next($request);
        }
        // Adds headers to the response
        $response->header('Access-Control-Allow-Origin', $allowedDomains);
        $response->header('Access-Control-Allow-Methods', 'OPTIONS, HEAD, GET, POST, PUT, PATCH, DELETE');
        $response->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));
    }

 

    // Sends it
    return $response;
}
}