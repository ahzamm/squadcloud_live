<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;
use App\Models\AllowedIp;
use Illuminate\Support\Facades\Log;


class CheckForMaintenanceMode extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $requestIp = $request->ip();
        if (app()->isDownForMaintenance()) {
            $allowedIps = AllowedIp::pluck('ip_address')->toArray();
            // dd($requestIp, $allowedIps);
            Log::info('Allowed IPs: ' . json_encode($allowedIps));

            // Check if the request IP is in the allowed IPs list
            if (!in_array($requestIp, $allowedIps)) {
                Log::warning('IP not allowed: ' . $requestIp);
                return response('Service Unavailablee', 503);
            } else {
                Log::info('IP allowed: ' . $requestIp);
            }
        }

        return $next($request);
    }
}
