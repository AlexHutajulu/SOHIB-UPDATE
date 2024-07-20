@extends('layouts.app')

@section('title', 'SOHIB | Sistem Online Hibah Banjarbaru')

@section('content')
    <div id="mapid" style="height: 600px; width: 100%;"></div>

    <!-- Include Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <!-- Include Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        #mapid {
            border-radius: 10px;
            z-index: 0;
        }
    </style>

    <script>
        var mymap = L.map("mapid").setView([-3.4559, 114.8387], 12);

        // Base maps
        var streets = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });

        var humanitarian = L.tileLayer("https://tile-{s}.openstreetmap.fr/hot/{z}/{x}/{y}.png", {
            attribution: 'Tiles &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        });

        var topographique = L.tileLayer("https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png", {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        });

        // Default base map
        streets.addTo(mymap);

        // Layer control
        var baseMaps = {
            "Streets": streets,
            "Humanitarian": humanitarian,
            "Topographique": topographique
        };

        L.control.layers(baseMaps).addTo(mymap);

        var markersLayer = new L.LayerGroup(); // layer contain markers
        mymap.addLayer(markersLayer);

        var data = [
            @foreach ($coordinates as $coordinate)
                {
                    loc: [{{ $coordinate['latitude'] }}, {{ $coordinate['longitude'] }}],
                    popup: `<strong>Nama:</strong> {{ $coordinate['submission']->name }}<br>
                            <strong>Nama Rumah Ibadah:</strong> {{ $coordinate['submission']->ibadah }}<br>
                            <strong>Status:</strong> 
                            <span class="{{ $coordinate['submission']->status == 'ditolak' ? 'badge bg-danger' : '' }}{{ $coordinate['submission']->status == 'disetujui' ? 'badge bg-success' : '' }}{{ $coordinate['submission']->status == 'proses' ? 'badge bg-secondary' : '' }}{{ $coordinate['submission']->status == 'diterima' ? 'badge bg-info' : '' }}{{ $coordinate['submission']->status == 'diketahui' ? 'badge bg-primary' : '' }}{{ $coordinate['submission']->status == 'pencairan' ? 'badge bg-info' : '' }}">
                                {{ $coordinate['submission']->status ?? 'NULL' }}
                            </span><br>
                            <button onclick="redirectToDetail('{{ route('submission.detail', ['id' => $coordinate['submission']->id]) }}')">Detail</button>`
                },
            @endforeach
        ];

        data.forEach(function(entry) {
            var marker = L.marker(entry.loc)
                .addTo(markersLayer)
                .bindPopup(entry.popup);
        });

        function redirectToDetail(url) {
            window.location.href = url;
        }
    </script>

@endsection
