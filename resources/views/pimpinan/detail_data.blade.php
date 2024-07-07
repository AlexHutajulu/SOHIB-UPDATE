@extends('layouts.pimpinan')

@section('title', 'Detail Submission')

@section('content')
    <div class="container mt-4">
        <h1>Detail Permohonan</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>NIK</th>
                        <td>{{ $submission->nik }}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>{{ $submission->name }}</td>
                    </tr>
                    <tr>
                        <th>No Telepon</th>
                        <td>{{ $submission->phone }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $submission->email }}</td>
                    </tr>
                    <tr>
                        <th>Nama Rumah Ibadah</th>
                        <td>{{ $submission->ibadah }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $submission->description }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Bank</th>
                        <td>{{ $submission->bank_name }}</td>
                    </tr>
                    <tr>
                        <th>No Rekening</th>
                        <td>{{ $submission->bank_account }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ $submission->status ?? 'NULL' }}</td>
                    </tr>
                    <!-- Tambahkan detail lain yang diperlukan -->
                </tbody>
            </table>
        </div>
    </div>
@endsection
