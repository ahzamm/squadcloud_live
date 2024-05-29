<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;
use App\Models\AllowedIp;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;


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
        // dd($request->ip());
        // Get the IP of the request
        $requestIp = $request->ip();
        Log::info('Request IP: ' . $requestIp);

        // Check if the application is in maintenance mode
        if (app()->isDownForMaintenance()) {
            // Retrieve allowed IPs
            $allowedIps = AllowedIp::pluck('ip_address')->toArray();
            Log::info('Allowed IPs: ' . json_encode($allowedIps));

            // Check if the request IP is in the allowed IPs list
            if (!in_array($requestIp, $allowedIps)) {
                Log::warning('IP not allowed: ' . $requestIp);
                // return response('Service Unavailablee', 503);
                throw new ServiceUnavailableHttpException(null, 'Service Unavailable', null, 503);
            } else {
                Log::info('IP allowed: ' . $requestIp);
            }
        }

        return $next($request);
    }
}
