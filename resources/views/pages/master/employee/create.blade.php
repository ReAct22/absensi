@extends('layouts.app')
@section('title', 'Add New Employee')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-header">
                    <h5 class="card-title">Create New Employee</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('employeed.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-3">
                            <label for="" class="form-label">Employee Code</label>
                            <input type="hidden" name="code" value="{{ $kode }}">
                            <input type="text" class="form-control" value="{{ $kode }}"
                                @disabled(true)>
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label">Full Name</label>
                            <input type="text" name="name"
                                class="form-control @error('name')
                            is-invalid
                        @enderror" value="{{old('name')}}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" name="email"
                                class="form-control @error('email')
                            is-invalid
                        @enderror" value="{{old('email')}}">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label">Phone Number</label>
                            <input type="text" name="nohp"
                                class="form-control @error('nohp')
                            is-invalid
                        @enderror" value="{{old('nohp')}}">
                            @error('nohp')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label">Gender</label>
                            <select name="gender" id=""
                                class="form-control @error('gender')
                                is-invalid
                            @enderror">
                                <option value="L">Laki-Laki</option>
                                <option value="P">Wanita</option>
                            </select>
                            @error('gender')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="" class="form-label">Department</label>
                                    <select name="department" id="department"
                                        class="form-control @error('department')
                                        is-invalid
                                    @enderror">
                                        <option value="">Silahkan Pilih Department</option>
                                        @foreach ($departments as $item)
                                            <option value="{{ $item->id }}">{{ $item->department_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('department')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label for="" class="form-label">Position</label>
                                    <select name="position" id="position"
                                        class="form-control @error('position')
                                        is-invalid
                                    @enderror"></select>
                                    @error('position')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label">Date Hire</label>
                            <input type="text" name="hire_date" id="datepicker" autocomplete="off"
                                class="form-control @error('hire_date')
                                is-invalid
                            @enderror" value="{{old('hire_date')}}">
                            @error('hire_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label">Status Employement</label>
                            <select name="status" id=""
                                class="form-control @error('status')
                                is-invalid
                            @enderror">
                                <option value="">Silahkan Pilih Status</option>
                                <option value="Tetap">Tetap</option>
                                <option value="Kontrak">Kontrak</option>
                                <option value="Magang">Magang</option>
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label">Photo Profile</label>
                            <input type="file" name="photo" id="" class="form-file @error('photo')
                                is-invalid
                            @enderror" value="{{old('photo')}}">
                            @error('photo')
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
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            let route = "{{ route('employeed.getPosition', ':id') }}"
            $('#position').prop('disabled', true)
            $('#position').html("<option value=''>-- Silahkan Pilih Department Dulu --</option>")
            $('#department').on('change', function() {
                let departmentId = $(this).val()
                // console.log(departmentId)
                if (departmentId === "") {
                    $('#position').prop('disabled', true)
                    $('#position').html("<option value=''>-- Silahkan Pilih Department Dulu --</option>")
                }

                if (departmentId) {
                    $('#position').prop('disabled', false)
                    $.ajax({
                        url: route.replace(':id', departmentId),
                        type: 'GET',
                        success: function(data) {
                            // console.log(data)
                            $('#position').empty()

                            $('#position').append(
                                '<option value="">Silahkan Pilih Posisi</option>')
                            $.each(data, function(key, value) {
                                $('#position').append(
                                    '<option value="' + value.id + '">' + value
                                    .position_name + '</option>'
                                )
                            })
                        }
                    })
                }


            })

            // Datepicker config
            $('#datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true
            })
        })
    </script>
@endpush
