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
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $submission->name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $submission->nik }}</h6>
                        <form action="{{ route('admin.approve', $submission->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Status:</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status"
                                        id="disetujui{{ $submission->id }}" value="disetujui">
                                    <label class="form-check-label" for="disetujui{{ $submission->id }}">Disetujui</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status"
                                        id="ditolak{{ $submission->id }}" value="ditolak">
                                    <label class="form-check-label" for="ditolak{{ $submission->id }}">Tidak
                                        Disetujui</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="note{{ $submission->id }}" class="form-label">Catatan:</label>
                                <textarea class="form-control" name="note" id="note{{ $submission->id }}" rows="2">{{ old('note') }}</textarea>
                                @error('note')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Submit</button>
                        </form>
                        <a href="{{ route('submission.detail', $submission->id) }}" class="btn btn-info btn-sm mt-auto">
                            <i class="fas fa-info-circle"></i> Detail Pemohon
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12">
                <p class="text-center">Tidak Ada Permohonan Baru</p>
            </div>
        @endforelse
    </div>

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
                            <th>Kelurahan</th>
                            <th>Ibadah</th>
                            <th>Lihat File</th>
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
                                <td>{{ $submission->bank->bank_name }}</td>
                                <td>{{ $submission->bank->bank_account }}</td>
                                <td>{{ $submission->kelurahan->kelurahan_name }}</td>
                                <td>{{ $submission->ibadah }}</td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <a href="{{ route('admin.file', $submission->id) }}"
                                        style="display: block; text-align: center;">
                                        <i class="fa-regular fa-eye fa-lg" style="color: #005eff;"></i>
                                    </a>
                                </td>
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
                                                        : ($submission->status == 'diketahui'
                                                            ? 'badge bg-primary'
                                                            : '')))) }}">
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
