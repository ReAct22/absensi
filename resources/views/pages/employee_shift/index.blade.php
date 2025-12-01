@extends('layouts.app')
@section('title', 'Employee Shift Manajamen')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="my-4">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                </div>
                <div class="my4">
                    <a href="{{route('employee-shift.create')}}" class="btn btn-success btn-sm">Add New</a>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Data Shift Employee</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Employee</th>
                                        <th>Shift</th>
                                        <th>Effective Date</th>
                                        <th>End Date</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($shiftEmployees as $item)
                                        <tr>
                                            <td>{{$item->Employee->full_name}}</td>
                                            <td>{{$item->Shift->shift_name}}</td>
                                            <td>{{$item->effective_date}}</td>
                                            <td>{{$item->end_date}}</td>
                                            <td>
                                                <a href="{{route('employee-shift.edit', $item->id)}}" class="btn btn-sm btn-warning">Edit</a>
                                                <form action="{{route('employee-shift.destroy', $item->id)}}" class="d-inline" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Data Tida ada</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
