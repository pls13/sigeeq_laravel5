<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\DB;
use Closure;

class LogQueryMW
{
    public function handle($request, Closure $next)
    {
        DB::enableQueryLog();
        return $next($request);
    }

    public function terminate($request, $response)
    {
        // Store or dump the log data...
        dd(DB::getQueryLog());
    }
}