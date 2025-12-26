@extends('layouts.app')
@section('title', 'Edit User')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">User {{$user->name}}</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('user.update', $user->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mt-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" class="form-control" value="{{$user->name}}" readonly>
                                <input type="hidden" name="name" value="{{$user->name}}">
                            </div>
                            <div class="mt-3">
                                <label for="" class="form-label">Email</label>
                                <input type="text" class="form-control" value="{{$user->email}}" readonly>
                                <input type="hidden" name="email" value="{{$user->email}}">
                            </div>
                            <div class="mt-3">
                                <label for="" class="form-label">Role</label>
                                <select name="role" id="role" class="form-control">
                                    @foreach (['Pegawai', 'HR', 'Manager'] as $role)
                                        <option value="{{$role}}" {{old('role', $user->role) == $role ? 'selected' : ''}}>
                                            {{$role}}
                                        </option>
                                    @endforeach
                                </select>
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
