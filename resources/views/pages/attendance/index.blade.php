@extends('layouts.app')
@section('title', 'Attendance List')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 p-5">
                <div class="mx-auto">
                    <button class="btn btn-sm btn-success">Presensi Manual</button>
                </div>
                <div class="my-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Attendance</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Employee ID</th>
                                            <th>Check IN</th>
                                            <th>Check OUT</th>
                                            <th>Status</th>
                                            <th>Work Hour</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="7" class="text-center">Data Tidak Ada</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
