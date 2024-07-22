<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;
use App\Models\AllowedIp;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;

class CheckForMaintenanceMode extends Middleware
{
    public function handle($request, Closure $next)
    {
        $requestIp = $request->ip();
        Log::info('Request IP: ' . $requestIp);

        if (app()->isDownForMaintenance()) {
            $allowedIps = AllowedIp::pluck('ip_address')->toArray();
            Log::info('Allowed IPs: ' . json_encode($allowedIps));

            // Check if the request IP is in the allowed IPs list
            if (!in_array($requestIp, $allowedIps)) {
                Log::warning('IP not allowed: ' . $requestIp);
                return response()->view('frontend.503', [], 503);
            } else {
                Log::info('IP allowed: ' . $requestIp);
            }
        }

        return $next($request);
    }
}
