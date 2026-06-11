<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSupplierRegistration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Currently a placeholder middleware that just lets the request pass.
        // Can be extended to check settings like 'is_supplier_registration_open'
        return $next($request);
    }
}
