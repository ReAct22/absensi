<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeShift;
use App\Models\Shift;
use Illuminate\Http\Request;

class EmployeeShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shiftEmployees = EmployeeShift::all();

        return view('pages.employee_shift.index', compact('shiftEmployees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        $shifts = Shift::all();

        return view('pages.employee_shift.create', compact('shifts', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer',
            'shift_id' => 'required|integer',
            'effective_date' => 'required|date',
            'end_date' => 'nullable|date'
        ]);

        EmployeeShift::create([
            'employee_id' => $request->employee_id,
            'shift_id' => $request->shift_id,
            'effective_date' => $request->effective_date,
            'end_date' => $request->end_date
        ]);

        return redirect()->route('employee-shift.index')->with('success', 'Data berhasil ditambahkan');
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
        $employee_shift = EmployeeShift::findOrFail($id);
        $employees = Employee::all();
        $shifts = Shift::all();

        return view('pages.employee_shift.edit', compact('employee_shift', 'employees', 'shifts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee_shift = EmployeeShift::findOrFail($id);
        $request->validate([
            'employee_id' => 'nullable|integer',
            'shift_id' => 'required|integer',
            'effective_date' => 'required|date',
            'end_date' =>  'required|date'
        ]);

        $employee_shift->update([
            'employee_id' => $employee_shift->employee_id,
            'shift_id' => $request->shift_id,
            'effective_date' => $request->effective_date,
            'end_date' => $request->end_date
        ]);

        return redirect()->route('employee-shift.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee_shift = EmployeeShift::findOrFail($id);

        $employee_shift->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
