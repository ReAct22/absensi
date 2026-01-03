<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function getProfile(){
        $user_id = Auth::user()->id;

        $profile = Employee::where('user_id', $user_id)->first();

        return response()->json([
            'status' => true,
            'message' => 'data berhasil diambil',
            'data' => $profile
        ]);
    }

    public function edit(Request $request){
        $request->validate([
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string',
            'gender' => 'nullable|string',
            'photo' => 'nullable|image|mimes:png,jpg,jpeg,webp'
        ]);

        $user_id = Auth::user()->id;

        $profile = Employee::where('user_id', $user_id)->first();
        $profilePath = null;

        if($request->hasFile('photo')){
            Storage::disk('public')->delete($profile->photo_profile);
            $profilePath = $request->file('photo')->store('profile', 'public');
        }

        $profile->update([
            'full_name' => $request->name ?? $profile->full_name,
            'phone_number' => $request->phone ?? $profile->phone_number,
            'gender' => $request->gender ?? $profile->gender,
            'photo_profile' => $photoPath ?? $profile->photo_profile
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diupdate',
            'data' => []
        ]);
    }
}
