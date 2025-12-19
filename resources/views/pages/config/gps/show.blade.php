@extends('layouts.app')
@section('title', 'GPS Detail')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ $geoFence->name }}</h5>
                    </div>
                    <div class="card-title">
                        <div id="map" style="height: 400px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        const lat = {{ $geoFence->latitude }};
        const lng = {{ $geoFence->longtitude }};
        const radius = {{$geoFence->radius}};
        const map = L.map('map').setView([lat, lng], 16);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribute: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        L.marker([lat, lng])
        .addTo(map)
        L.circle([lat, lng], {
            radius: radius,
            color: 'blue',
            fillColor: '#3b82f6',
            fillOpocity: 0.2
        }).addTo(map)
    </script>
@endpush
