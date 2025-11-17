<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Position::all();

        return view('pages.master.position.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $department = Departments::all();

        return view('pages.master.position.create', compact('department'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'required',
            'level' => 'required|integer'
        ]);

        Position::create([
            'position_name' => $request->name,
            'department_id' => $request->department,
            'description' => $request->name,
            'level' => $request->level
        ]);

        return redirect()->route('position.index')->with('success', 'Data berhasil disimpan');
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
        $position = Position::findOrFail($id);

        $department = Departments::all();

        return view('pages.master.position.edit', compact('position', 'department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|integer'
        ]);

        $position = Position::findOrFail($id);

        $position->update([
            'position_name' => $request->name,
            'department_id' => $position->department_id,
            'level' => $request->level
        ]);

        return redirect()->route('position.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $position = Position::findOrFail($id);

        $position->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
