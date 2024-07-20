@extends('layouts.masyarakat')

@section('title', 'SOHIB | Sistem Online Hibah Banjarbaru')

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
                <h1 class="card-title mb-0">Data Permohonan Anda</h1>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody>
                            @forelse ($submissions as $submission)
                                <tr>
                                    <th>NIK</th>
                                    <td>{{ $submission->nik }}</td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $submission->name }}</td>
                                <tr>
                                    <th>Kelurahan</th>
                                    <td>{{ $submission->kelurahan->kelurahan_name }}</td>
                                </tr>
                                </tr>
                                <tr>
                                    <th>No Telepon</th>
                                    <td>{{ $submission->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Pengajuan</th>
                                    <td>{{ $submission->tanggalpengajuan->tanggal_pengajuan ?? 'N/A' }}</td>
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
                                    <td>{{ $submission->bank->bank_name }}</td>
                                </tr>
                                <tr>
                                    <th>No Rekening</th>
                                    <td>{{ $submission->bank->bank_account }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $submission->address }}</td>
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
                                                            : ($submission->status == 'diketahui'
                                                                ? 'badge bg-primary'
                                                                : ($submission->status == 'pencairan'
                                                                    ? 'badge bg-info'
                                                                    : ''))))) }}">
                                            {{ $submission->status ?? 'NULL' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <a href="{{ route('submissions.file', $submission->id) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye fa-lg"></i> Lihat
                                        </a>
                                        @if ($submission->status == 'ditolak')
                                            <a href="{{ route('submissions.resubmit', $submission->id) }}"
                                                class="btn btn-success btn-sm">
                                                <i class="fas fa-redo fa-lg"></i> Ajukan Ulang
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">
                                        <div class="alert alert-info">
                                            Anda belum mengajukan permohonan hibah.
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function openFileInput(id) {
            document.getElementById('fileInput' + id).click();
        }

        function submitForm(input) {
            input.closest('form').submit();
        }
    </script>
@endsection
