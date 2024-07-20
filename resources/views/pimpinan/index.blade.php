@extends('layouts.pimpinan')

@section('title', 'SOHIB | Sistem Online Hibah Banjarbaru')

@section('content')
    <div class="container">
        <h1 class="mt-4 mb-3"><strong>Sebaran Permohonan</strong></h1>
        <div id="mapid" style="height: 500px; border-radius: 10px;"></div>

        <!-- Include Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

        <!-- Include Leaflet JavaScript -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

        <style>
            #mapid {
                width: 100%;
                /* Ubah nilai lebar sesuai kebutuhan */
                height: 600px;
                /* Tetapkan tinggi peta */
                border-radius: 10px;
                margin: auto;
                /* Agar peta berada di tengah */
            }
        </style>

        <script>
            var mymap = L.map("mapid");

            // Menentukan batas koordinat untuk wilayah Banjarbaru
            var southWest = L.latLng(-3.5104, 114.7499);
            var northEast = L.latLng(-3.3947, 114.9124);
            var bounds = L.latLngBounds(southWest, northEast);

            mymap.fitBounds(bounds); // Memuat peta sesuai dengan batas yang ditentukan

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
                            <button onclick="redirectToDetail('{{ route('pimpinan.permohonan', ['id' => $coordinate['submission']->id]) }}')">Detail</button>`
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

    </div>
@endsection
