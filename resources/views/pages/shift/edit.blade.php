@extends('layouts.app')
@section('title', 'Edit Shift')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('shift.update', $shift->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mt-3">
                                <label for="" class="form-label">Name Shift</label>
                                <input type="text" name="name" class="form-control @error('name')
                                    is-invalid
                                @enderror" value="{{$shift->shift_name}}">
                                @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="" class="form-label">Start Time</label>
                                <input type="time" name="start_time" id="startTime" class="form-control @error('start_time')
                                    is-invalid
                                @enderror" value="{{$shift->start_time}}">
                                @error('start_time')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="" class="form-label">End Time</label>
                                <input type="time" name="end_time" id="" class="form-control @error('end_time')
                                    is-invalid
                                @enderror" value="{{$shift->end_time}}">
                                @error('end_time')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="" class="form-label">Tolerance Time</label>
                                 <input type="text" name="tolerance_time" class="form-control @error('tolerance_time')
                                    is-invalid
                                 @enderror" value="{{$shift->tolerance_time}}" >
                                 @error('tolerance_time')
                                    <small class="text-danger">{{$message}}</small>
                                 @enderror
                            </div>
                            <div class="mt-3">
                                <label for="" class="form-label">Working Days</label>
                                <select name="working_days" id="" class="form-control @error('working_days')
                                    is-invalid
                                @enderror" disabled>
                                    <option value="Senin, Selasa, Rabu, Kamis, Jum'at">Mon-Fri</option>
                                    <option value="Senin, Selasa, Kamis">Mon-thu</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

