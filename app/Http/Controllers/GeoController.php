<?php

namespace App\Http\Controllers;

use App\Models\GeoFence;
use Illuminate\Http\Request;

class GeoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $geoFences = GeoFence::all();

        return view('pages.config.gps.index', compact('geoFences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.config.gps.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required',
            'longtitude' => 'required',
            'radius' => 'required|integer'
        ]);

        GeoFence::create([
            'name' => $request->name,
            'latitude' => $request->latitude,
            'longtitude' => $request->longtitude,
            'radius' => $request->radius
        ]);

        return redirect()->route('geo-fance.index')->with('success', 'Data Berhasil di input');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $geoFence = GeoFence::findOrFail($id);

        return view('pages.config.gps.show', compact('geoFence'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $geoFence = GeoFence::findOrFail($id);

        return view('pages.config.gps.edit', compact('geoFence'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $geo = GeoFence::findOrFail($id);

        $request->validate([
            'name' => 'string|max:255',
            'radius' => 'integer'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
