@extends('layouts.app')
@section('title', 'Data Leave Request')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Leave Request</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Date Request</th>
                                        <th>Total Days</th>
                                        <th>Status</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($leaves as $item)
                                        <tr>
                                            <td>{{ $item->employee->employee_code }}</td>
                                            <td>{{ $item->employee->full_name }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->total_days }}</td>
                                            <td><span
                                                    class="badge {{ $item->status == 'approved' ? 'badge-success' : ($item->status == 'pending' ? 'badge-warning' : 'badge-danger') }}">{{ $item->status }}</span>
                                            </td>
                                            <td>
                                                <a href="{{route('leave-approve.show', $item->id)}}" class="btn btn-sm btn-primary">Show</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Data Tidak ditemukan</td>
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
