<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shifts = Shift::all();
        return view('pages.shift.index', compact('shifts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.shift.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'tolerance_time' => 'required|string',
            'working_days' => 'required|string'
        ]);

        Shift::create([
            'shift_name' => $request->name,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'tolerance_time' => $request->tolerance_time,
            'working_days' => $request->working_days
        ]);

        return redirect()->route('shift.index')->with('success', 'Data berhasil disimpan');
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
        $shift = Shift::findOrFail($id);

        return view('pages.shift.edit', compact('shift'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $shift = Shift::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'tolerance_time' => 'required|string',
            'working_days' => 'nullable|string'
        ]);

        $shift->update([
            'shift_name' => $request->name,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'tolarance_time' => $request->tolerance_time,
            'working_days' => $shift->working_days
        ]);

        return redirect()->route('shift.index')->with('success', 'Data berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shift = Shift::findOrFail($id);

        $shift->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
