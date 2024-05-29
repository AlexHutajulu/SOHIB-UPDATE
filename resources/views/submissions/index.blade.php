@extends('layouts.masyarakat')

@section('title', 'SOHIB | Sistem Online Hibah Banjarbaru')

@section('content')
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        @if(auth()->check() && auth()->user()->role === 'masyarakat')
    <li class="breadcrumb-item active">{{ auth()->user()->name }}</li>
    @endif
    </ol>
    <div class="row">
        <!-- Bagian card Anda -->
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data Pengajuan Anda
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama Lengkap</th>
                        <th>Alamat</th>
                        <th>Ibadah</th>
                        <th>No Telepon</th>
                        <th>Jenis Bank</th>
                        <th>No Rekening</th>
                        <th>Email</th>
                        <th>Dokumen Anda</th>
                        <th>Status</th>
                        <th>Note</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($submissions as $submission)
                        <tr>
                            <td>{{ $submission->nik }}</td>
                            <td>{{ $submission->name }}</td>
                            <td>{{ $submission->address }}</td>
                            <td>{{ $submission->ibadah }}</td>
                            <td>{{ $submission->phone }}</td>
                            <td>{{ $submission->bank_name }}</td>
                            <td>{{ $submission->bank_account}}</td>
                            <td>{{ $submission->email }}</td>
                            <td style="text-align: center; vertical-align: middle;">
                                <a href="{{ route('submissions.file', $submission->id) }}" style="display: block; text-align: center;">
                                    <i class="fa-regular fa-eye fa-lg" style="color: #005eff;"></i>
                                </a>
                            </td>    
                            <td>{{ $submission->status }}</td>
                            <td>{{ $submission->note }}</td>
                            <td>
                                <!-- Actions di sini, contoh: -->
                                <a href="#" class="btn btn-primary">Ajukan Ulang</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
