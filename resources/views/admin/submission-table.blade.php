@extends('layouts.app')

@section('title', 'SOHIB | Sistem Online Hibah Banjarbaru')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2 class="card-title">Data Permohonan Yang Sudah Diproses</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatablesSimple" class="table table-striped table-hover" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>No Telepon</th>
                                        <th>Jenis Bank</th>
                                        <th>No Rekening</th>
                                        <th>Ibadah</th>
                                        <th>Lihat File</th>
                                        <th>Upload SK</th>
                                        <th>Catatan</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($submissions as $submission)
                                        @if (
                                            $submission->status == 'disetujui' ||
                                                $submission->status == 'ditolak' ||
                                                $submission->status == 'diterima' ||
                                                $submission->status == 'pencairan')
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
                                                <td>{{ $submission->bank_name }}</td>
                                                <td>{{ $submission->bank_account }}</td>
                                                <td>{{ $submission->ibadah }}</td>
                                                <td style="text-align: center;">
                                                    <a href="{{ route('admin.file', $submission->id) }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fa-regular fa-eye" style="color: white;"></i>
                                                    </a>
                                                </td>
                                                <td style="text-align: center;">
                                                    <form action="{{ route('admin.uploadSk', $submission->id) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="file" name="sk_file" accept=".pdf, .doc, .docx"
                                                            id="fileInput{{ $submission->id }}" class="d-none"
                                                            onchange="submitForm(this)">
                                                        <button type="button" class="btn btn-success btn-sm"
                                                            onclick="openFileInput({{ $submission->id }})">Upload</button>
                                                    </form>
                                                </td>
                                                <td>{{ $submission->note }}</td>
                                                <td>
                                                    <span
                                                        class="{{ $submission->status == 'ditolak'
                                                            ? 'btn btn-danger btn-sm'
                                                            : ($submission->status == 'disetujui'
                                                                ? 'btn btn-success btn-sm'
                                                                : ($submission->status == 'proses'
                                                                    ? 'btn btn-secondary btn-sm'
                                                                    : ($submission->status == 'diterima'
                                                                        ? 'btn btn-info btn-sm'
                                                                        : ''))) }}">
                                                        {{ $submission->status ?? 'NULL' }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <form action="{{ route('admin.destroy', $submission->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                                                    </form>
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
        </div>
    </div>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function openFileInput(submissionId) {
            document.getElementById(`fileInput${submissionId}`).click();
        }

        function submitForm(input) {
            input.form.submit();
        }
    </script>
@endsection
