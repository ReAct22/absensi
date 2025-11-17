@extends('layouts.app')
@section('title', 'Presensi Manual')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 p-5">
                <div class="my-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Input Data Presensi</h3>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="mt-3">
                                    <label for="" class="form-label">Nama Pegawai</label>
                                    <select name="employee_id" class="form-control" id="">
                                        <option value="">Pilih Nama Pegawai</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mt-3">
                                            <label for="" class="form-label">Check-in</label>
                                            <input type="time" class="form-control" name="" id="">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="mt-3">
                                            <label for="" class="form-label">Check-out</label>
                                            <input type="time" class="form-control" name="" id="">
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label for="" class="form-label">Status</label>
                                    <select name="status" id="" class="form-control">
                                        <option value="">Pilih Status</option>
                                        <option value="Hadir">Hadir</option>
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-sm btn-primary" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
