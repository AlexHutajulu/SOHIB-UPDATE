@extends('layouts.app')

@section('title', 'Edit Submission')

@section('content')
    <h1 class="mt-4">Edit Submission</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.new') }}">New Submissions</a></li>
        <li class="breadcrumb-item active">Edit Submission</li>
    </ol>

    <form action="{{ route('admin.update', $submission->id) }}" method="post" enctype="multipart/form-data" class="row g-2">
        @csrf
        @method('PUT') {{-- Gunakan metode PUT untuk mengirimkan formulir edit --}}
        <!-- Formulir Anda -->
        <div class="col-md-6">
            <label for="nik" class="form-label">NIK :</label>
            <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" id="nik"
                placeholder="Masukkan NIK Anda" value="{{ old('nik', $submission->nik) }}">
            @error('nik')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="name" class="form-label">Nama :</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                placeholder="Masukkan nama lengkap Anda" value="{{ old('name', $submission->name) }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="phone" class="form-label">Nomor Telepon :</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone"
                placeholder="Masukkan nomor telepon Anda" value="{{ old('phone', $submission->phone) }}">
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="email" class="form-label">Email :</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                placeholder="Masukkan nomor telepon Anda" value="{{ old('email', $submission->email) }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="ibadah" class="form-label">Nama tempat Ibadah :</label>
            <input type="text" class="form-control @error('ibadah') is-invalid @enderror" name="ibadah" id="ibadah"
                placeholder="Masukkan nama tempat Ibadah Secara Lengkap" value="{{ old('ibadah', $submission->ibadah) }}">
            @error('ibadah')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="budget" class="form-label">Anggaran Biaya :</label>
            <input type="number" class="form-control @error('budget') is-invalid @enderror" name="budget" id="budget"
                placeholder="Masukkan nominal Rencana Anggaran Biaya" value="{{ old('budget', $submission->budget) }}">
            @error('budget')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="bank_account" class="form-label">Rekening BANK :</label>
            <input type="text" class="form-control @error('bank_account') is-invalid @enderror" name="bank_account" id="bank_account"
                placeholder="Masukkan No rekening BANK atas Nama Tempat Ibadah" value="{{ old('bank_account', $submission->bank_account) }}">
            @error('bank_account')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="address" class="form-label">Alamat :</label>
            <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address"
                      placeholder="Masukkan alamat Anda">{{ old('address', $submission->address) }}</textarea>
            @error('address')
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
        
            @if ($submission->application_letter)
                <p class="mt-2">File Saat Ini: <a href="{{ asset('public/storage/'.$submission->application_letter) }}" target="_blank">{{ $submission->application_letter }}</a></p>
            @else
                <p class="mt-2">Tidak ada file terlampir.</p>
            @endif
        </div>
        <div class="col-md-6">
            <label for="documentation" class="form-label">Dokumentasi foto Tempat Ibadah</label>
            <input class="form-control @error('documentation') is-invalid @enderror" type="file"
                name="documentation" id="documentation">
            @error('documentation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        
            @if ($submission->documentation)
                <p class="mt-2">File Saat Ini: <a href="{{ asset('path/ke/file/'.$submission->documentation) }}" target="_blank">{{ $submission->documentation}}</a></p>
            @else
                <p class="mt-2">Tidak ada file terlampir.</p>
            @endif
        </div>
        <div class="col-md-6">
            <label for="tanah" class="form-label">Akta Tanah</label>
            <input class="form-control @error('tanah') is-invalid @enderror" type="file"
                name="tanah" id="tanah">
            @error('tanah')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        
            @if ($submission->tanah)
                <p class="mt-2">File Saat Ini: <a href="{{ asset('path/ke/file/'.$submission->tanah) }}" target="_blank">{{ $submission->tanah}}</a></p>
            @else
                <p class="mt-2">Tidak ada file terlampir.</p>
            @endif
        </div>
        <div class="col-md-6">
            <label for="rab" class="form-label">List Barang Keperluan</label>
            <input class="form-control @error('rab') is-invalid @enderror" type="file"
                name="rab" id="rab">
            @error('rab')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        
            @if ($submission->rab)
                <p class="mt-2">File Saat Ini: <a href="{{ asset('path/ke/file/'.$submission->rab) }}" target="_blank">{{ $submission->rab}}</a></p>
            @else
                <p class="mt-2">Tidak ada file terlampir.</p>
            @endif
        </div>
        <div class="col-md-6">
            <label for="land_certificate" class="form-label">DSK kepengurusan</label>
            <input class="form-control @error('land_certificade') is-invalid @enderror" type="file"
                name="land_certificate" id="land_certificate">
            @error('land_certificate')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        
            @if ($submission->land_certificade)
                <p class="mt-2">File Saat Ini: <a href="{{ asset('path/ke/file/'.$submission->land_certificate) }}" target="_blank">{{ $submission->land_certificade}}</a></p>
            @else
                <p class="mt-2">Tidak ada file terlampir.</p>
            @endif
        </div>
        <div class="col-md-6">
            <label for="management_letter" class="form-label">SKT</label>
            <input class="form-control @error('management_letter') is-invalid @enderror" type="file"
                name="management_letter" id="management_letter">
            @error('management_letter')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        
            @if ($submission->management_letter)
                <p class="mt-2">File Saat Ini: <a href="{{ asset('path/ke/file/'.$submission->management_letter) }}" target="_blank">{{ $submission->management_letter}}</a></p>
            @else
                <p class="mt-2">Tidak ada file terlampir.</p>
            @endif
        </div>
        <div class="col-md-6">
            <label for="npwp" class="form-label">NPWP Perwakilan</label>
            <input class="form-control @error('npwp') is-invalid @enderror" type="file"
                name="npwp" id="npwp">
            @error('npwp')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        
            @if ($submission->npwp)
                <p class="mt-2">File Saat Ini: <a href="{{ asset('path/ke/file/'.$submission->npwp) }}" target="_blank">{{ $submission->npwp}}</a></p>
            @else
                <p class="mt-2">Tidak ada file terlampir.</p>
            @endif
        </div>
        <div class="col-md-6">
            <label for="domicile_letter" class="form-label">Surat domisili</label>
            <input class="form-control @error('domicile_letter') is-invalid @enderror" type="file"
                name="domicile_letter" id="domicile_letter">
            @error('domicile_letter')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        
            @if ($submission->domicile_letter)
                <p class="mt-2">File Saat Ini: <a href="{{ asset('path/ke/file/'.$submission->domicile_letter) }}" target="_blank">{{ $submission->domicile_letter}}</a></p>
            @else
                <p class="mt-2">Tidak ada file terlampir.</p>
            @endif
        </div>

        <div class="col">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection
