<?php

namespace AutoPaginationLaravel\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PaginateMiddleware
{
  public function handle(Request $request, Closure $next)
  {
    $response = $next($request);

    if ($request->has('page')) {
      return app()->make('paginated_response');
    }

    return $response;
  }
}
