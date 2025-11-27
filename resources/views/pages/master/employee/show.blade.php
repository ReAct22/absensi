@extends('layouts.app')
@section('title', 'Data Employee')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                {{-- <h3>Data Pribadi</h3> --}}
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <img src="{{ asset('storage/' . $employeed->photo_profile) }}" alt=""
                                    class="card-img-top">
                            </div>
                            <div class="col-sm-5">
                                <div class="mt-3">
                                    <label for="" class="form-label">Code Employee</label>
                                    <input type="text" class="form-control" disabled value="{{$employeed->employee_code}}">
                                </div>
                                <div class="mt-3">
                                    <label for="" class="form-label">Name</label>
                                    <input type="text" class="form-control" disabled value="{{ $employeed->full_name }}">
                                </div>
                                <div class="mt-3">
                                    <label for="" class="form-label">Email</label>
                                    <input type="text" class="form-control" disabled value="{{$employeed->email}}">
                                </div>
                                <div class="mt-3">
                                    <label for="" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" disabled value="{{$employeed->phone_number}}">
                                </div>
                                <div class="mt-3">
                                    <label for="" class="form-label">Gender</label>
                                    <input type="text" class="form-control" disabled value="{{$employeed->gender == 'L' ? 'Laki-Laki' : 'Perempuan'}}">
                                </div>
                                <div class="mt-3">
                                    <label for="" class="form-label">Department</label>
                                    <input type="text" class="form-control" disabled value="{{$employeed->department->department_name}}">
                                </div>
                                <div class="mt-3">
                                    <label for="" class="form-label">Position</label>
                                    <input type="text" class="form-control" disabled value="{{$employeed->position->position_name}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
