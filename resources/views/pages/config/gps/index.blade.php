@extends('layouts.app')
@section('title', 'GPS Config')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="my-3">
                    <a href="{{ route('geo-fance.create') }}" class="btn btn-sm btn-success">Add New</a>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Config GPS</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Latitude</th>
                                        <th>longtitude</th>
                                        <th>Radius</th>
                                        <th>option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($geoFences as $item)
                                        <tr>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->latitude}}</td>
                                            <td>{{$item->longtitude}}</td>
                                            <td>{{$item->radius}}</td>
                                            <td>
                                                <a href="{{route('geo-fance.edit', $item->id)}}" class="btn btn-sm btn-warning">Edit</a>
                                                <a href="{{route('geo-fance.show', $item->id)}}" class="btn btn-success btn-sm">Show</a>
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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
