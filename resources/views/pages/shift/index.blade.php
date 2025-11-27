@extends('layouts.app')
@section('title', 'Data Shift')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="mt-3">
                    <a href="" class="btn btn-sm btn-success">Add New</a>
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
                                            <td></td>
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
