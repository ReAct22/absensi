@extends('layouts.app')
@section('title', 'Edit Data Position')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit Data Position {{ $position->position_name }}</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('position.update', $position->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mt-3">
                                <label for="" class="form-label">Name Position</label>
                                <input type="text"
                                    class="form-control @error('name')
                                is-invalid
                            @enderror"
                                    name="name" value="{{ $position->position_name }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="" class="form-label">Department</label>
                                <select name="department" id=""
                                    class="form-control @error('department') is-invlaid @enderror" @if ($position->department_id)
                                        @disabled(true)
                                    @endif>
                                    <option value="{{ $position->department_id ? $position->department_id : '' }}">
                                        {{ $position->department->department_name ? $position->department->department_name : 'Silahkan Pilih Department' }}
                                    </option>
                                    @foreach ($department as $item)
                                        <option value="{{ $item->id }}">{{ $item->department_name }}</option>
                                    @endforeach
                                </select>
                                @error('department')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="" class="form-label">Level Grade</label>
                                <input type="text" name="level" value="{{$position->level}}"
                                    class="form-control @error('level')
                                is-invalid
                            @enderror">
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
