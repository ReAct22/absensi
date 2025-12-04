@extends('layouts.app')
@section('title', 'Show Leave Request ' . $leave->employee->full_name)

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <div class="row align-items-start">

                        {{-- Foto --}}
                        <div class="col-md-4 text-center mb-4">
                            <img
                                src="{{ asset('storage/' . $leave->employee->photo_profile) }}"
                                alt="Photo"
                                class="img-fluid rounded shadow-sm"
                                style="max-height: 350px; object-fit: cover;"
                            >
                        </div>

                        {{-- Data Karyawan --}}
                        <div class="col-md-8">

                            <h4 class="mb-4">Employee Information</h4>

                            <form>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Code Employee</label>
                                    <input type="text" value="{{ $leave->employee->employee_code }}" class="form-control" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label fw-bold">Leave Type</label>
                                    <input type="text" class="form-control" disabled value="{{$leave->leave_type}}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Name Employee</label>
                                    <input type="text" value="{{ $leave->employee->full_name }}" class="form-control" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="form-label fw-bold">Start Date</label>
                                    <input type="text" name="" id="" value="{{$leave->start_date}}" disabled="disabled" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label fw-bold">End Date</label>
                                    <input type="text" name="" id="" value="{{$leave->end_date}}" disabled="disabled" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label fw-bold">Total Days</label>
                                    <input type="text" name="" id="" disabled="disabled" value="{{$leave->status}}" class="form-control">
                                </div>
                                <input type="hidden" name="approved_by" value="{{Auth::user()->name}}">
                                <div class="mb-3">
                                    @if($leave->attachment)
                                        <a href="{{asset('storage/'. $leave->attachment)}}" download="" class="btn btn-sm btn-warning">Download</a>
                                    @endif
                                    @if(Auth::user()->role == "Manager")
                                    <button name="aksi" value="approve" class="btn btn-sm btn-success">Approve</button>
                                    <button name="aksi" value="rejected"  class="btn btn-sm btn-danger">Rejected</button>
                                    @endif
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
