@extends('layouts.app')
@section('title', 'Data Employee')
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
                    <a href="{{route('employeed.create')}}" class="btn btn-sm btn-success">Add New</a>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Data Employee</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Employee Code</th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Department</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($employees as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->full_name}}</td>
                                            <td>{{$item->position->position_name}}</td>
                                            <td>{{$item->department->department_name}}</td>
                                            <td>
                                                {{-- <a href="" class="btn btn-sm btn-warning">Edit</a> --}}
                                                <a href="{{route('employeed.show', $item->id)}}" class="btn btn-sm btn-success">Show</a>
                                                <form action="{{route('employeed.destroy', $item->id)}}" class="d-inline" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Data Tidak ada</td>
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
