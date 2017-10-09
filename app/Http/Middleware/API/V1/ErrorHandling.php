<?php
namespace App\Http\Middleware\API\V1;

use App\Exceptions\APIErrorException;

class ErrorHandling
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, $next)
    {
        $response = $next($request);

        if (!empty($response->exception) && $response->exception instanceof APIErrorException) {
            return $response->exception->getErrorResponse();
        }

        return $response;
    }
}
