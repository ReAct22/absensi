@extends('layouts.app')
@section('title', 'Data Department')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
                <div class="my-3">
                    <a href="{{ route('department.create') }}" class="btn btn-sm btn-success">Add new Data</a>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Data Department</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Department Name</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($departments as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->department_name }}</td>
                                            <td>
                                                <a href="{{route('department.edit',$item->id)}}" class="btn btn-sm btn-warning me-1">Edit</a>
                                                <form action="{{route('department.destroy', $item->id)}}" method="post" class="d-inline ">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Data Tidak ada</td>
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
