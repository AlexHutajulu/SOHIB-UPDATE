@extends('layouts.app')

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
                        <th>Kelurahan</th>
                        <td>{{ $submission->kelurahan->kelurahan_name }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Pengajuan</th>
                        <td>{{ $submission->tanggalpengajuan->tanggal_pengajuan ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Diterima</th>
                        <td>{{ $submission->otorisasi->otorisasi_pimpinan ?? 'kosong' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Pencairan</th>
                        <td>{{ $submission->berita_acara->tanggal_pencairan ?? 'kosong' }}</td>
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
                        <th>Surat Pengantar</th>
                        <td class="text-center align-middle">
                            <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'application_letter']) }}"
                                target="_blank" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye fa-lg"></i> Lihat
                            </a>
                            <a href="{{ route('submissions.download_file', ['id' => $submission->id, 'type' => 'application_letter']) }}"
                                class="btn btn-success btn-sm">
                                <i class="fas fa-cloud-download-alt fa-lg"></i> Unduh
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Foto Tempat Ibadah</th>
                        <td class="text-center align-middle">
                            <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'documentation']) }}"
                                target="_blank" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye fa-lg"></i> Lihat
                            </a>
                            <a href="{{ route('submissions.download_file', ['id' => $submission->id, 'type' => 'documentation']) }}"
                                class="btn btn-success btn-sm">
                                <i class="fas fa-cloud-download-alt fa-lg"></i> Unduh
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Akta Tanah</th>
                        <td class="text-center align-middle">
                            <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'tanah']) }}"
                                target="_blank" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye fa-lg"></i> Lihat
                            </a>
                            <a href="{{ route('submissions.download_file', ['id' => $submission->id, 'type' => 'tanah']) }}"
                                class="btn btn-success btn-sm">
                                <i class="fas fa-cloud-download-alt fa-lg"></i> Unduh
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>RAB</th>
                        <td class="text-center align-middle">
                            <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'rab']) }}"
                                target="_blank" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye fa-lg"></i> Lihat
                            </a>
                            <a href="{{ route('submissions.download_file', ['id' => $submission->id, 'type' => 'rab']) }}"
                                class="btn btn-success btn-sm">
                                <i class="fas fa-cloud-download-alt fa-lg"></i> Unduh
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>SK Kepengurusan</th>
                        <td class="text-center align-middle">
                            @if ($submission->land_certificate)
                                <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'land_certificate']) }}"
                                    target="_blank" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye fa-lg"></i> Lihat
                                </a>
                                <a href="{{ route('submissions.download_file', ['id' => $submission->id, 'type' => 'land_certificate']) }}"
                                    class="btn btn-success btn-sm">
                                    <i class="fas fa-cloud-download-alt fa-lg"></i> Unduh
                                </a>
                            @else
                                <span>File Kosong</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>SKT</th>
                        <td class="text-center align-middle">
                            <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'management_letter']) }}"
                                target="_blank" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye fa-lg"></i> Lihat
                            </a>
                            <a href="{{ route('submissions.download_file', ['id' => $submission->id, 'type' => 'management_letter']) }}"
                                class="btn btn-success btn-sm">
                                <i class="fas fa-cloud-download-alt fa-lg"></i> Unduh
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Akta Notaris/Surat Berbadan Hukum</th>
                        <td class="text-center align-middle">
                            @if ($submission->notaris)
                                <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'notaris']) }}"
                                    target="_blank" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye fa-lg"></i> Lihat
                                </a>
                                <a href="{{ route('submissions.download_file', ['id' => $submission->id, 'type' => 'notaris']) }}"
                                    class="btn btn-success btn-sm">
                                    <i class="fas fa-cloud-download-alt fa-lg"></i> Unduh
                                </a>
                            @else
                                <span>File Kosong</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>NPWP Perwakilan</th>
                        <td class="text-center align-middle">
                            <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'npwp']) }}"
                                target="_blank" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye fa-lg"></i> Lihat
                            </a>
                            <a href="{{ route('submissions.download_file', ['id' => $submission->id, 'type' => 'npwp']) }}"
                                class="btn btn-success btn-sm">
                                <i class="fas fa-cloud-download-alt fa-lg"></i> Unduh
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Surat Domisili</th>
                        <td class="text-center align-middle">
                            <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'domicile_letter']) }}"
                                target="_blank" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye fa-lg"></i> Lihat
                            </a>
                            <a href="{{ route('submissions.download_file', ['id' => $submission->id, 'type' => 'domicile_letter']) }}"
                                class="btn btn-success btn-sm">
                                <i class="fas fa-cloud-download-alt fa-lg"></i> Unduh
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Surat Keputusan Admin</th>
                        <td class="text-center align-middle">
                            @if ($submission->sk_file)
                                <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'sk_file']) }}"
                                    target="_blank" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye fa-lg"></i> Lihat
                                </a>
                                <a href="{{ route('submissions.download_file', ['id' => $submission->id, 'type' => 'sk_file']) }}"
                                    class="btn btn-success btn-sm">
                                    <i class="fas fa-cloud-download-alt fa-lg"></i> Unduh
                                </a>
                            @else
                                <span>File Kosong</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Surat Keputusan Kelurahan</th>
                        <td class="text-center align-middle">
                            @if ($submission->surat_kelurahan)
                                <a href="{{ route('surat_kelurahan.show', ['id' => $submission->id]) }}" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye fa-lg"></i> Lihat
                                </a>
                                <a href="{{ route('surat_kelurahan.download', ['id' => $submission->id]) }}"
                                    class="btn btn-success btn-sm">
                                    <i class="fas fa-cloud-download-alt fa-lg"></i> Unduh
                                </a>
                            @else
                                <span class="text-muted">File Kosong</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Surat Keputusan Pimpinan</th>
                        <td class="text-center align-middle">
                            @if ($submission->suratpimpinan)
                                <a href="{{ route('showsuratpimpinan', ['id' => $submission->id]) }}" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye fa-lg"></i> Lihat
                                </a>
                                <a href="{{ route('unduhsuratpimpinan', ['id' => $submission->id]) }}"
                                    class="btn btn-success btn-sm">
                                    <i class="fas fa-cloud-download-alt fa-lg"></i> Unduh
                                </a>
                            @else
                                <span class="text-muted">File Kosong</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
