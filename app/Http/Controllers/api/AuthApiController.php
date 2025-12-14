<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use App\Models\LoginAudit;
use App\Models\UserSession;
use Carbon\Carbon;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_id' => 'required',
            'device_name' => 'nullable'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email atau password salah'
            ], 401);
        }

        $device = $user->devices()
            ->where('device_id', $request->device_id)
            ->first();

        if (!$device) {
            $otp = rand(100000, 999999);

            $user->update([
                'otp_code' => $otp,
                'otp_expires_at' => now()->addMinutes(5),
            ]);

            Mail::to($user->email)->send(new OtpMail($otp));

            return response()->json([
                'message' => 'OTP telah dikirim ke email Anda',
                'email' => $user->email,
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login sukses',
            'token' => $token,
            'user' => $user,
        ]);
    }


    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp_code' => 'required',
            'device_id' => 'required',
            'device_name' => 'nullable'
        ]);

        $user = User::where('email', $request->email)
            ->where('otp_code', $request->otp_code)
            ->first();

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan']);
        }

        if ($user->otp_code !== $request->otp_code || now()->greaterThan($user->otp_expires_at)) {
            return response()->json(['message' => 'Kode OTP tidak valid atau sudah kedaluwars']);
        }

        $user->devices()->create([
            'device_id' => $request->device_id,
            'device_name' => $request->device_name,
            'ip_address' => $request->ip(),
            'last_login_at' => now()
        ]);

        // Hapus OTP setelah valid
        $user->update([
            'otp_code' => null,
            'otp_expires_at' => null
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        UserSession::create([
            'user_id' => $user->id,
            'token' => $token,
            'expires_at' => Carbon::now()->addMinutes(30)
        ]);

        $auditdata = [
            'email' => $request->email,
            'ip_address' => $request->ip,
            'user_agent' => $request->header('user-agent'),
            'logged_at' => now()
        ];

        LoginAudit::create(array_merge($auditdata, [
            'user_id' => $user->id,
            'success' => true,
            'message' => 'Login Berhasil'
        ]));

        return response()->json([
            'message' => 'Login berhasil',
            'user' => $user,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $token = $request->bearerToken();
        $user = $request->user();

        // hapus Session
        UserSession::where('token', $token)->delete();

        $request->user()->currentAccessToken()->delete();

        $auditdata = [
            'email' => $user->email,
            'ip_address' => $request->ip,
            'user_agent' => $request->header('user-agent'),
            'logged_at' => now()
        ];

        LoginAudit::create(array_merge($auditdata, [
            'user_id' => $user->id,
            'success' => true,
            'message' => 'Logout Sukses'
        ]));

        return response()->json([
            'message' => 'Logout Sukses'
        ]);
    }

    public function profile(Request $request)
    {
        return response()->json([
            'user' => "Hallo Andrean"
        ]);
    }
}
