@extends('layouts.kelurahan')

@section('title', 'SOHIB | Sistem Online Hibah Banjarbaru')
<link rel="stylesheet" href="css/create.css">

@section('content')
    <h1 class="mt-4">Ajukan Permohonan Anda</h1>
    <form action="{{ route('submissions.store') }}" method="post" enctype="multipart/form-data" class="row g-2">
        @csrf
        <div class="col-md-6">
            <label for="nik" class="form-label">NIK :</label>
            <input type="number" class="form-control @error('nik') is-invalid @enderror" name="nik" id="nik"
                placeholder="Masukkan NIK Anda" value="{{ old('nik') }}" maxlength="16">
            @error('nik')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <script>
            const nikInput = document.getElementById('nik');
            nikInput.addEventListener('input', function() {
                if (nikInput.value.length > 16) {
                    nikInput.value = nikInput.value.slice(0, 16);
                }
            });
        </script>
        <div class="col-md-6">
            <label for="name" class="form-label">Nama :</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                placeholder="Masukkan nama lengkap Anda" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="phone" class="form-label">Nomor Telepon :</label>
            <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone"
                placeholder="Masukkan No Telepon Anda" value="{{ old('phone') }}" maxlength="15">
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <script>
            const phoneInput = document.getElementById('phone');
            phoneInput.addEventListener('input', function() {
                if (phoneInput.value.length > 15) {
                    phoneInput.value = phoneInput.value.slice(0, 15);
                }
            });
        </script>
        <div class="col-md-6">
            <label for="email" class="form-label">Email :</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                placeholder="Masukkan Email anda" value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="kelurahan_name" class="form-label">Nama Kelurahan :</label>
            <select class="form-select select2 @error('kelurahan_name') is-invalid @enderror" name="kelurahan_name"
                id="kelurahan_name">
                <option value="">Pilih Kelurahan</option>
                <option value="Guntung Paikat">Guntung Paikat</option>
                <option value="Kemuning">Kemuning</option>
                <option value="Loktabat Selatan">Loktabat Selatan</option>
                <option value="Loktabat Utara">Loktabat Utara</option>
                <option value="Sungai Besar">Sungai Besar</option>
                <option value="Komet">Komet</option>
                <option value="Mentaos">Mentaos</option>
                <option value="Sungai Ulin">Sungai Ulin</option>
                <option value="Bangkal">Bangkal</option>
                <option value="Cempaka">Cempaka</option>
                <option value="Palam">Palam</option>
                <option value="Sungai Tiung">Sungai Tiung</option>
                <option value="Guntung Manggis">Guntung Manggis</option>
                <option value="Guntung Payung">Guntung Payung</option>
                <option value="Landasan Ulin Timur">Landasan Ulin Timur</option>
                <option value="Syamsudin Noor">Syamsudin Noor</option>
                <option value="Landasan Ulin Barat">Landasan Ulin Barat</option>
                <option value="Landasan Ulin Selatan">Landasan Ulin Selatan</option>
                <option value="Landasan Ulin Tengah">Landasan Ulin Tengah</option>
                <option value="Landasan Ulin Utara">Landasan Ulin Utara</option>
            </select>
            @error('kelurahan_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="ibadah" class="form-label">Nama Tempat Ibadah :</label>
            <input type="text" class="form-control @error('ibadah') is-invalid @enderror" name="ibadah" id="ibadah"
                placeholder="Masukkan nama Tempat Ibadah Secara Lengkap" value="{{ old('ibadah') }}">
            @error('ibadah')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="budget" class="form-label">Anggaran Biaya :</label>
            <div class="input-group">
                <span class="input-group-text">Rp</span>
                <input type="number" class="form-control @error('budget') is-invalid @enderror" name="budget"
                    id="budget" placeholder="Masukkan Nominal Rencana Anggaran Biaya" value="{{ old('budget') }}">
            </div>
            @error('budget')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="bank_name" class="form-label">Bank :</label>
            <select class="form-select @error('bank_name') is-invalid @enderror" name="bank_name" id="bank_name">
                <option value="">Pilih Bank</option>
                <option value="BRI">BRI</option>
                <option value="BNI">BNI</option>
                <option value="Mandiri">Mandiri</option>
                <option value="Bank Kalsel">Bank Kalsel</option>
            </select>
            @error('bank_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="bank_account" class="form-label">No Rekening Bank :</label>
            <input type="text" class="form-control @error('bank_account') is-invalid @enderror" name="bank_account"
                placeholder="Masukkan No Rekening Dengan Atas Nama Ibadah" id="bank_account"
                value="{{ old('bank_account') }}">
            @error('bank_account')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="application_letter" class="form-label">Surat Pengantar Proposal</label>
            <input class="form-control @error('application_letter') is-invalid @enderror" type="file"
                name="application_letter" id="application_letter">
            @error('application_letter')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="documentation" class="form-label">Dokumentasi foto tempat Ibadah</label>
            <input class="form-control @error('documentation') is-invalid @enderror" type="file" name="documentation"
                id="documentation">
            @error('documentation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="tanah" class="form-label">Akta Tanah</label>
            <input class="form-control @error('tanah') is-invalid @enderror" type="file" name="tanah"
                id="tanah">
            @error('tanah')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="rab" class="form-label">List Barang Keperluan</label>
            <input class="form-control @error('rab') is-invalid @enderror" type="file" name="rab"
                id="rab">
            @error('rab')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="land_certificate" class="form-label">SK kepengurusan</label>
            <input class="form-control @error('land_certificate') is-invalid @enderror" type="file"
                name="land_certificate" id="land_certificate">
            @error('land_certificate')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="management_letter" class="form-label">SKT</label>
            <input class="form-control @error('management_letter') is-invalid @enderror" type="file"
                name="management_letter" id="management_letter">
            @error('management_letter')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="notaris" class="form-label">Akta Notaris/Surat Berbadan Hukum</label>
            <input class="form-control @error('notaris') is-invalid @enderror" type="file" name="notaris"
                id="notaris">
            @error('notaris')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="npwp" class="form-label">NPWP Perwakilan</label>
            <input class="form-control @error('npwp') is-invalid @enderror" type="file" name="npwp"
                id="npwp">
            @error('npwp')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="domicile_letter" class="form-label">Surat domisili</label>
            <input class="form-control @error('domicile_letter') is-invalid @enderror" type="file"
                name="domicile_letter" id="domicile_letter">
            @error('domicile_letter')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-12">
            <label for="address" class="form-label">Alamat :</label>
            <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" rows="3">{{ old('address') }}</textarea>

            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Maps Section -->
        <div class="col-md-12">
            <p>Silahkan pilih titik lokasi tempat rumah ibadah:</p>
            <label for="latitude" class="form-label">Garis Lintang :</label>
            <input type="text" class="form-control @error('latitude') is-invalid @enderror" name="latitude"
                id="latitude" placeholder="Garis Lintang akan terisi otomatis saat memilih lokasi di peta"
                value="{{ old('latitude') }}" readonly>
            @error('latitude')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="longitude" class="form-label">Garis bujur :</label>
            <input type="text" class="form-control @error('longitude') is-invalid @enderror" name="longitude"
                id="longitude" placeholder="Garis bujur akan terisi otomatis saat memilih lokasi di peta"
                value="{{ old('longitude') }}" readonly>
            @error('longitude')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div id="map" style="height: 400px;"></div>
        </div>


        <div class="col">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

    <!-- Peta menggunakan Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-3.455886669409714, 114.80846523992699], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker;

        function onMapClick(e) {
            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker(e.latlng).addTo(map);
            document.getElementById('latitude').value = e.latlng.lat;
            document.getElementById('longitude').value = e.latlng.lng;
        }

        map.on('click', onMapClick);
    </script>
@endsection
