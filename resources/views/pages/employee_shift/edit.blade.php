@extends('layouts.app')
@section('title', 'Edit Employee Shift')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('employee-shift.update', $employee_shift->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mt-3">
                                <label for="" class="form-label">Employee</label>
                                <select name="employee_id" class="form-control @error('employee_id')
                                    is-invalid
                                @enderror" disabled>
                                    <option value="{{$employee_shift->employee_id}}">{{$employee_shift->Employee->full_name}}</option>
                                </select>
                                @error('employee_id')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="" class="form-label">Shift</label>
                                <select name="shift_id" class="form-control @error('shift_id')
                                    is-invalid
                                @enderror" id="">
                                <option value="{{$employee_shift->shift_id}}">{{$employee_shift->Shift->shift_name}}</option>
                                @foreach ($shifts as $shift)
                                    <option value="{{$shift->id}}">{{$shift->shift_name}}</option>
                                @endforeach
                                </select>
                                @error('shift_id')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="" class="form-label">Effective Date</label>
                                <input type="text" name="effective_date" id="effective_date" class="form-control @error('effective_date')
                                    is-invalid
                                @enderror" value="{{$employee_shift->effective_date}}">
                                @error('effective_date')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="" class="form-label">End Date</label>
                                <input type="text" name="end_date" id="end_date" class="form-control @error('end_date')
                                    is-invalid
                                @enderror" value="{{$employee_shift->end_date}}">
                                @error('end_date')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <button class="btn btn-sm btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $("#effective_date").datepicker({
                format: "yyyy-mm-dd",
                autoclose: true,
                todayHighlight: true
            });

            $("#end_date").datepicker({
                format: "yyyy-mm-dd",
                autoclose: true,
                todayHighlight: true
            })
        })
    </script>
@endpush
