@extends('layouts.app')
@section('title', 'Edit GPS')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title fw-bold">{{ $geoFence->name }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="mt-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name="name"
                                class="form-control @error('name')
                                is-invalid
                            @enderror"
                                value="{{ $geoFence->name }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label">GeoLocation</label>
                            <div id="map" style="height: 400px"></div>
                            <input type="hidden" name="longtitude" id="longtitude" value="{{ $geoFence->longtitude }}">
                            <input type="hidden" name="latitude" id="latitude" value="{{ $geoFence->latitude }}">
                            @error('longtitude')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            @error('latitude')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label">Radius</label>
                            <input type="text" name="radius"
                                class="form-control @error('radius')
                                is-invalid
                            @enderror"
                                value="{{ $geoFence->radius }}">
                            @error('radius')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-sm btn-primary" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        const lat = {{ $geoFence->latitude }};
        const long = {{ $geoFence->longtitude }};
        const map = L.map('map').setView([lat, long], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribute: '&copy; OpenStreetMap contributors'
        }).addTo(map)

        map.setView([lat, long], 16);
        L.marker([lat, long])
        .addTo(map)

        let marker;

        map.on('click', function(e){
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;

            if(marker){
                marker.setLatLng(e.latlng);
            } else {
                marker = L.marker(e.latlng).addTo(map);
            }

            document.getElementById('latitude').value = lat;
            document.getElementById('longtitude').value = lng
        })
    </script>
@endpush
