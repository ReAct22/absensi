@extends('layouts.app')
@section('title', 'Add New Department')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Add New Department</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('department.store')}}" method="POST">
                            @csrf
                            <div class="mt-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name')
                                    is-invalid
                                @enderror" name="name">
                                @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="" class="form-label">Description</label>
                                <textarea name="description" class="form-control @error('description')
                                    'is-invalid'
                                @enderror" id="" cols="30" rows="10"></textarea>
                                @error('description')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
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
