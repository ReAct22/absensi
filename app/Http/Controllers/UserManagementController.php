<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::lazy();
        return view('pages.config.user_management.index', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('pages.config.user_management.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'role' => 'required|in:Pegawai,HR,Manager'
        ]);

        try{
            $user = User::findOrFail($id);
            $user->update([
                'role' => $request->role
            ]);

            return redirect()->route('user.index')->with('success', 'Data user sudah diupdate');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        try{
            $user->delete();
            return redirect()->back()->with('success', 'Data user berhasil dihapus');
        } catch(Exception $e){
            return redirect()->back()->with('error', $e);
        }
    }
}
