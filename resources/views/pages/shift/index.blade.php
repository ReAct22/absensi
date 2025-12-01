@extends('layouts.app')
@section('title', 'Data Shift')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
                <div class="my-3">
                    <a href="{{route('shift.create')}}" class="btn btn-sm btn-success">Add New</a>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Shift</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Shift Name</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Working Days</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($shifts as $item)
                                        <tr>
                                            <td>{{$item->shift_name}}</td>
                                            <td>{{$item->start_time}}</td>
                                            <td>{{$item->end_time}}</td>
                                            <td>{{$item->working_days}}</td>
                                            <td>
                                                <a href="{{route('shift.edit', $item->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{route('shift.destroy', $item->id)}}" class="d-inline" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty

                                        <tr>
                                            <td colspan="5" class="text-center">Data Tidak ditemukan</td>
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
