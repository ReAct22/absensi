<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Carbon\Carbon;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau password salah']
            ]);
        }

        // Generate OTP 6 digit
        $otp = rand(100000, 999999);
        // dd($user);

        // Simpan OTP ke database
        $user->update([
            'otp_code' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(5)
        ]);


        // Kirim OTP via email
        Mail::to($user->email)->send(new OtpMail($otp));

        return response()->json([
            'message' => 'OTP telah dikirim ke email Anda',
            'email' => $user->email
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp_code' => 'required'
        ]);

        $user = User::where('email', $request->email)
            ->where('otp_code', $request->otp_code)
            ->first();

        if(!$user){
            return response()-> json(['message' => 'Kode OTP salah'], 401);
        }

        if(Carbon::now()->greaterThan($user->otp_expires_at)){
            return response()->json(['message' => 'Kode OTP telah Kadaluwars']);
        }

        // Hapus OTP setelah valid
        $user->update([
            'otp_code' => null,
            'otp_expires_at' => null
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'user' => $user,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout Sukses'
        ]);
    }

    public function profile(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }
}
