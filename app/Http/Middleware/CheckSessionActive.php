<?php

namespace App\Http\Middleware;

use App\Models\UserSession;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSessionActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        if(!$token){
            return response()->json(['message' => 'Token tidak ditemukan']);
        }

        $session = UserSession::where('token', $token)->first();

        if(!$session){
            return response()->json(['message' => 'Sesi tidak valid']);
        }

        if($session->isExpired){
            // hapus token sanctum & session
            $request->user()->currentAccessToken()->delete();
            $session->delete();
            return response()->json(['message' => 'Sesi sudah kadaluwarsa, silahkan login ulang']);
        }

        $session->update([
            'expires_at' => now()->addMinutes(30)
        ]);

        return $next($request);
    }
}
