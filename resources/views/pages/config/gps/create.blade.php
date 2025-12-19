@extends('layouts.app')
@section('title', 'Add New Geo')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Add New Geo</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('geo-fance.store')}}" method="POST">
                            @csrf
                            <div class="mt-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control @error('name')
                                    is-invalid
                                @enderror" placeholder="Input Name...">
                                @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror

                            </div>
                            <div class="mt-3">
                                <label for="" class="form-label">Map</label>
                                <div id="map" style="height: 400px" class=""></div>
                                <input type="hidden" name="longtitude" id="longtitude">
                                <input type="hidden" name="latitude" id="latitude">
                                @error('longtitude')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                @error('latitude')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="" class="form-label">Radius</label>
                                <input type="text" class="form-control @error('radius')
                                    is-invalid
                                @enderror" name="radius" placeholder="Radius  M">
                                @error('radius')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-sm btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        const map = L.map('map').setView([-6.200000, 106.816666], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribute: '&copy; OpenStreetMap contributors'
        }).addTo(map);
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(
                function(position){
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    map.setView([lat, lng], 16);

                    L.marker([lat, lng])
                    .addTo(map)
                    .bindPopup('posisi anda saat ini')
                    .openPopup()

                    document.getElementById('latitude').value = lat;
                    document.getElementById('longtitude').value = lng;
                },
                function(error){
                    alert('Gagal mendapatkan lokasi');
                },
                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                },
            );
        } else {
            alert('Browser tidak mendukung gps')
        }

        let marker;

        map.on('click', function(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;

            if (marker) {
                marker.setLatLng(e.latlng);
            } else {
                marker = L.marker(e.latlng).addTo(map);
            }

            // console.log(lat, lng);
            document.getElementById('latitude').value = lat;
            document.getElementById('longtitude').value = lng;
        });
    </script>
@endpush
