@extends('layouts.masyarakat')

@section('title', 'SOHIB | Sistem Online Hibah Banjarbaru')
<link rel="stylesheet" href="css/create.css">

@section('content')
    <h1 class="mt-4">Ajukan Permohonan Anda</h1>
    <form action="{{ route('submissions.store') }}" method="post" enctype="multipart/form-data" class="row g-2">
        @csrf
        <div class="col-md-6">
            <label for="nik" class="form-label">NIK :</label>
            <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" id="nik"
            placeholder="Masukkan NIK Anda"   value="{{ old('nik') }}">
            @error('nik')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="name" class="form-label">Nama :</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
            placeholder="Masukkan nama lengkap Anda"  value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="phone" class="form-label">Nomor Telepon :</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone"
            placeholder="Masukkan No Telepon Anda" value="{{ old('phone') }}">
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="email" class="form-label">Email :</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
            placeholder="Masukkan Email anda"   value="{{ old('email') }}">
            @error('email')
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
                <input type="number" class="form-control @error('budget') is-invalid @enderror" name="budget" id="budget"
                placeholder="Masukkan Nominal Rencana Anggaran Biaya" value="{{ old('budget') }}">
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
                <!-- Tambahkan bank lainnya sesuai kebutuhan -->
            </select>
            @error('bank_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="bank_account" class="form-label">No Rekening Bank :</label>
            <input type="text" class="form-control @error('bank_account') is-invalid @enderror" name="bank_account"
            placeholder="Masukkan No Rekening Dengan Atas Nama Ibadah" id="bank_account" value="{{ old('bank_account') }}">
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
            <input class="form-control @error('notaris') is-invalid @enderror" type="file"
                name="notaris" id="notaris">
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
        <div class="col">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection
