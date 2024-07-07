@extends('layouts.kelurahan')

@section('title', 'SOHIB | Sistem Online Hibah Banjarbaru')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4 text-left">Dashboard</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @if (auth()->check() && auth()->user()->role === 'kelurahan')
                    <li class="breadcrumb-item active" aria-current="page">{{ auth()->user()->name }}</li>
                @endif
            </ol>
        </nav>
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h2 class="card-title">Data Pengajuan Anda</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatablesSimple" class="table table-striped table-hover" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>Alamat</th>
                                <th>Rumah Ibadah</th>
                                <th>No Telepon</th>
                                <th>Jenis Bank</th>
                                <th>No Rekening</th>
                                <th>file</th>
                                <th>Status</th>
                                <th>Note</th>
                                <th>Ajukan Ulang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($submissions as $submission)
                                <tr>
                                    <td>
                                        <div>{{ $submission->name }}</div>
                                        <div class="text-muted">{{ $submission->email }}</div>
                                    </td>
                                    <td>{{ $submission->address }}</td>
                                    <td>{{ $submission->ibadah }}</td>
                                    <td>{{ $submission->phone }}</td>
                                    <td>{{ $submission->bank_name }}</td>
                                    <td>{{ $submission->bank_account }}</td>
                                    <td style="text-align: center;">
                                        <a href="{{ route('submissions.file', $submission->id) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye fa-lg"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <span
                                            class="{{ $submission->status == 'ditolak' ? 'btn btn-danger btn-sm' : ($submission->status == 'disetujui' ? 'btn btn-success btn-sm' : ($submission->status == 'proses' ? 'btn btn-secondary btn-sm' : '')) }}">
                                            {{ $submission->status ?? 'NULL' }}
                                        </span>
                                    </td>
                                    <td>{{ $submission->note }}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm">Ajukan Ulang</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


