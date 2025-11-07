<?php

namespace App\Http\Middleware;

use App\Models\OfficeIp;
use Closure;
use Illuminate\Http\Request;
use PHPUnit\Logging\OpenTestReporting\Status;
use Symfony\Component\HttpFoundation\Response;

class ValidateOfficeIp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $clientIp = $request->ip();
        $allowedIps = OfficeIp::pluck('ip_address')->toArray();

        // Bandingkan IP pengguna dengan daftar yang diizinkan
        if(!in_array($clientIp, $allowedIps)){
            return response()->json([
                'status' => false,
                'message' => "Absensi ditolak: Ip $clientIp tidak terdaftar dijaringan"
            ], 403);
        }
        return $next($request);
    }
}
