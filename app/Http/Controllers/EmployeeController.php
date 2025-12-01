<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use function Symfony\Component\Clock\now;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function generateKodeKaryawan(){
        $prefix = "SPK";
        $date = now()->format('ymd');

        // ambil data terakhir hari ini
                      $last = Employee::whereDate('created_at', now())
        ->orderBy('id', 'DESC')
        ->first();

        if($last){
            $number = intval(substr($last->employee_code, -4) + 1);
        } else {
            $number = 1;
        }

        $running = str_pad($number, 4, '0', STR_PAD_LEFT);

        return $prefix.$date.$running;
    }

    public function GetPosition($id_department){
        $positions = Position::where('department_id', $id_department)->get();
        return response()->json($positions);
    }

    public function index()
    {
        $employees = Employee::all();
        // $kode = $this->generateKodeKaryawan();

        return view('pages.master.employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Departments::all();
        $kode = $this->generateKodeKaryawan();
        $positions = Position::all();

        return view('pages.master.employee.create', compact('departments', 'kode', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kode = $this->generateKodeKaryawan();
        $request->validate([
            'code' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nohp' => 'nullable|regex:/^[0-9]+$/|min:10',
            'gender' => 'required|string|max:1',
            'department' => 'required|integer',
            'position' => 'required|integer',
            'hire_date' => 'required|date',
            'status' => 'required',
            'photo' => 'nullable|file|mimes:jpg,jpeg,png|max:2048'
        ]);

        $position = Position::where('id', $request->id)->get();

        // dd($request->all());

        $profilePath = null;

        if($request->hasFile('photo')){
            $profilePath = $request->file('photo')->store('profile', 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('1235678'),
            'role' => $request->position == 'Manager' ? 'Manager' : 'Pegawai'
        ]);

        Employee::create([
            'employee_code' => $kode,
            'full_name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->nohp ? $request->nohp : '000000',
            'gender' => $request->gender,
            'position_id' => $request->position,
            'department_id' => $request->department,
            'hire_date' => $request->hire_date,
            'employment_status' => $request->status,
            'photo_profile' => $profilePath ? $profilePath : 'adadad',
            'user_id' => $user->id
        ]);

        return redirect()->route('employeed.index')->with('success', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employeed = Employee::findOrFail($id);

        return  view('pages.master.employee.show', compact('employeed'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employeed = Employee::findOrFail($id);
        if($employeed->photo_profile && Storage::disk('public')->exists($employeed->photo_profile)){
            Storage::disk('public')->delete($employeed->photo_profile);
        }

        $employeed->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
