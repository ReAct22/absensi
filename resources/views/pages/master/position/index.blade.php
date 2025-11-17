@extends('layouts.app')
@section('title', 'Data Position')
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
                <div class="my-4">
                    <a href="{{route('position.create')}}" class="btn btn-sm btn-success">Add New</a>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Data Position</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Name Department</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($positions as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->position_name}}</td>
                                            <td>{{$item->department->department_name}}</td>
                                            <td>
                                                <a href="" class="btn btn-sm btn-warning">Edit</a>
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Data Tidak ada</td>
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
@push('script')
<script>
    setTimeout(() => {
        let alert = document.querySelector('.alert');
        if(alert){
            alert.remove();
        }
    }, 3000);
</script>
@endpush
