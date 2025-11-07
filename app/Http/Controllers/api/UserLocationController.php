<?php

namespace App\Http\Controllers\api;

use App\Helpers\GeoHelper;
use App\Http\Controllers\Controller;
use App\Models\GeoFence;
use App\Models\UserLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLocationController extends Controller
{
    public function store(Request $request){
        $request->validate([
            // 'user_id' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longtitude' => 'required|numeric',
            'device_info' => 'nullable|string'
        ]);

        $user = Auth::user();

        $geo = GeoFence::first();

        $distance = GeoHelper::distance(
            $request->latitude,
            $request->longtitude,
            $geo->latitude,
            $geo->longtitude
        );

        if($distance > $geo->radius){
            return response()->json([
                'status' => false,
                'message' => 'Anda berada di luar area yang diizinkan ('.round($distance).' m dari kantor)'
            ], 403);
        }

        $location = UserLocation::create([
            'user_id' => $user->id, 
            'latitude' => $request->latitude,
            'longtitude' => $request->longtitude,
            'device_info' => $request->device_info,
            'tracked_at' => now()
        ]);

        return response()->json([
            'message' => 'Lokasi tersimpan',
            'data' => $location
        ], 201);
    }

    public function history(){
        $location = UserLocation::where('user_id', Auth::id())->orderByDesc('tracked_at')->get();
        return response()->json([
            $location
        ]);
    }
}
