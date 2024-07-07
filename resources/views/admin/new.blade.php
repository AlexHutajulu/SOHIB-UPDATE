@extends('layouts.app')

@section('title', 'SOHIB | Sistem Online Hibah Banjarbaru')

@section('content')
    <h1 class="mt-4"></h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"></li>
    </ol>

    {{-- Bagian untuk menampilkan submission yang belum diapprove/reject --}}
    <div class="row">
        @forelse ($newSubmissions as $submission)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">{{ $submission->nik }}</h3>
                        <h5 class="card-title">{{ $submission->name }}</h5>
                        <form action="{{ route('admin.approve', $submission->id) }}" method="POST">
                            @csrf
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="disetujui"
                                    value="disetujui">
                                <label class="form-check-label" for="disetujui">Disetujui</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="ditolak"
                                    value="ditolak">
                                <label class="form-check-label" for="ditolak">Tidak Disetujui</label>
                            </div>
                            <div class="col-md-12">
                                <label for="note" class="form-label">Catatan :</label>
                                <textarea class="form-control" name="note" id="note" rows="3">{{ old('note') }}</textarea>
                                @error('note')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary my-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12">
                <p>No new submissions.</p>
            </div>
        @endforelse
    </div>

    {{-- Bagian untuk menampilkan tabel submission yang sudah diapprove/reject --}}
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data Pengajuan Masyarakat
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>No Telepon</th>
                            <th>Jenis Bank</th>
                            <th>No Rekening</th>
                            <th>Ibadah</th>
                            <th>Lihat File</th>
                            <th>Upload SK</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($newSubmissions as $submission)
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
                                <td style="text-align: center; vertical-align: middle;">
                                    <a href="{{ route('admin.file', $submission->id) }}"
                                        style="display: block; text-align: center;">
                                        <i class="fa-regular fa-eye fa-lg" style="color: #005eff;"></i>
                                    </a>
                                </td>
                                <td style="text-align: center;">
                                    <form action="{{ route('admin.uploadSk', $submission->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="sk_file" accept=".pdf, .doc, .docx"
                                            id="fileInput{{ $submission->id }}" class="d-none" onchange="submitForm(this)">
                                        <button type="button" class="btn btn-success btn-sm"
                                            onclick="openFileInput({{ $submission->id }})">Upload</button>
                                    </form>
                                </td>
                                <td>
                                    <span class="btn btn-sm {{ $submission->status == 'proses' ? 'btn-secondary' : '' }}">
                                        {{ $submission->status ?? 'NULL' }}
                                    </span>
                                </td>
                                <td class="table-actions">
                                    <form action="{{ route('admin.destroy', $submission->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                                    </form>
                                </td>
                        @endforeach
                    </tbody>
                </table>
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
