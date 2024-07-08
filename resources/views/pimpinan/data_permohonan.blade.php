@extends('layouts.pimpinan')

@section('title', 'SOHIB | Sistem Online Hibah Banjarbaru')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4 text-left">Daftar Permohonan Hibah</h1>
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h2 class="card-title">Data Permohonan yang Sedang Diproses</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatablesSimple" class="table table-bordered table-striped table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>No Telepon</th>
                                <th>Nama Kelurahan</th>
                                <th>Nama Rumah Ibadah</th>
                                <th>Alamat</th>
                                <th>Surat Keputusan Pimpinan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($submissions as $submission)
                                @if ($submission->status == 'disetujui' || $submission->status == 'ditolak' || $submission->status == 'diterima')
                                    <tr>
                                        <td>{{ $submission->nik }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="ms-3">
                                                    <p class="fw-bold mb-1">{{ $submission->name }}</p>
                                                    <p class="text-muted mb-0">{{ $submission->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $submission->phone }}</td>
                                        <td>{{ $submission->kelurahan_name }}</td>
                                        <td>{{ $submission->ibadah }}</td>
                                        <td>{{ $submission->address }}</td>
                                        <td style="text-align: center;">
                                            <form action="{{ route('surat_pimpinan.upload', $submission->id) }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="file" name="file_pimpinan" accept=".pdf, .doc, .docx"
                                                    id="fileInput{{ $submission->id }}" class="d-none"
                                                    onchange="submitForm(this)">
                                                <button type="button" class="btn btn-success btn-sm"
                                                    onclick="openFileInput({{ $submission->id }})">
                                                    <i class="fas fa-upload"></i> Upload
                                                </button>
                                            </form>
                                            @if ($submission->suratpimpinan && $submission->suratpimpinan->file_pimpinan)
                                                <a href="{{ route('surat_pimpinan.show', $submission->id) }}"
                                                    class="btn btn-info btn-sm mt-1 ml-1" target="_blank">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <span
                                                class="
                                                @if ($submission->status == 'ditolak') btn btn-danger btn-sm
                                                @elseif ($submission->status == 'disetujui') btn btn-success btn-sm
                                                @elseif ($submission->status == 'proses') btn btn-secondary btn-sm
                                                @else btn btn-secondary btn-sm @endif">
                                                {{ $submission->status ?? 'NULL' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function openFileInput(submissionId) {
            document.getElementById(`fileInput${submissionId}`).click();
        }

        function submitForm(input) {
            input.form.submit();
        }
    </script>
@endsection

@section('styles')
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('scripts')
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
