@extends('layouts.pimpinan')

@section('title', 'Detail Submission')

@section('content')
    <div class="container mt-4">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h1 class="card-title mb-0">Detail Permohonan</h1>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
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
                                <td>{{ $submission->note }}</td>
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
                                <td>
                                    <span
                                        class="{{ $submission->status == 'ditolak'
                                            ? 'badge bg-danger'
                                            : ($submission->status == 'disetujui'
                                                ? 'badge bg-success'
                                                : ($submission->status == 'proses'
                                                    ? 'badge bg-secondary'
                                                    : ($submission->status == 'diterima'
                                                        ? 'badge bg-info'
                                                        : ''))) }}">
                                        {{ $submission->status ?? 'NULL' }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-center">
                @if ($submission->status == 'disetujui')
                    <form action="{{ route('pimpinan.updateStatus', ['id' => $submission->id, 'status' => 'diterima']) }}"
                        method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-info mx-2">Terima</button>
                    </form>
                    <form action="{{ route('pimpinan.updateStatus', ['id' => $submission->id, 'status' => 'ditolak']) }}"
                        method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-danger mx-2">Tolak</button>
                    </form>
                    <form action="{{ route('surat_pimpinan.upload', $submission->id) }}" method="post"
                        enctype="multipart/form-data" class="d-inline">
                        @csrf
                        <input type="file" name="file_pimpinan" accept=".pdf, .doc, .docx"
                            id="fileInput{{ $submission->id }}" class="d-none" onchange="submitForm(this)">
                        <button type="button" class="btn btn-success mx-2" onclick="openFileInput({{ $submission->id }})">
                            <i class="fas fa-upload"></i> Upload
                        </button>
                    </form>
                    @endif
                    @if ($submission->status == 'diterima' && $submission->suratpimpinan && $submission->suratpimpinan->file_pimpinan)
                        <a href="{{ route('surat_pimpinan.show', $submission->id) }}" class="btn btn-info mx-2"
                            target="_blank">
                            <i class="fas fa-eye"></i> Lihat
                        </a>
                    @endif
            </div>
        </div>
    </div>
@endsection

<script>
    function openFileInput(id) {
        document.getElementById('fileInput' + id).click();
    }

    function submitForm(input) {
        input.closest('form').submit();
    }
</script>
