@extends('layouts.app')
@section('title', 'Edit Department')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit Department</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('department.update', $department->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mt-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control @error('name')
                                    is-invalid
                                @enderror" value="{{$department->department_name}}">
                            </div>
                            <div class="mt-3">
                                <label for="" class="form-label">Description</label>
                                <textarea name="description" class="form-control @error('description')
                                    is-invalid
                                @enderror" id="" cols="30" rows="10">{{$department->description}}</textarea>
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
