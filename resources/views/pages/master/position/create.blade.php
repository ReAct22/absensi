@extends('layouts.app')
@section('title', 'New Data Position')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Input Data Position</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('position.store') }}" method="POST">
                            @csrf
                            <div class="mt-3">
                                <label for="" class="form-label">Name Position</label>
                                <input type="text" name="name"
                                    class="form-control @error('name')
                                    is-invalid
                                @enderror">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="" class="form-label">Department</label>
                                <select name="department"
                                    class="form-control @error('department')
                                    is-invalid
                                @enderror"
                                    id="">
                                    <option value="">Pilih Department</option>
                                    @foreach ($department as $item)
                                        <option value="{{ $item->id }}">{{ $item->department_name }}</option>
                                    @endforeach
                                </select>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="" class="form-label">Level Grade</label>
                                <input type="text"
                                    class="form-control @error('level')
                                    is-invalid
                                @enderror"
                                    name="level">
                                @error('level')
                                    <small class="text-danger">{{ $message }}</small>
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
