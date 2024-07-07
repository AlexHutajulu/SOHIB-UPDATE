@extends('layouts.app')

@section('title', 'File Masyarakat')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4 text-center">File Masyarakat</h1>
        <h3 class="mb-4 text-center">Pemilik: {{ $submission->name }}</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Jenis Dokumen</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Surat Pengantar</td>
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
                        <td>Foto Tempat Ibadah</td>
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
                        <td>Akta Tanah</td>
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
                        <td>Barang Yang Diperlukan</td>
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
                        <td>SK Kepengurusan</td>
                        <td class="text-center align-middle">
                            @if ($submission->management_letter)
                                <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'management_letter']) }}"
                                    target="_blank" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye fa-lg"></i> Lihat
                                </a>
                                <a href="{{ route('submissions.download_file', ['id' => $submission->id, 'type' => 'management_letter']) }}"
                                    class="btn btn-success btn-sm">
                                    <i class="fas fa-cloud-download-alt fa-lg"></i> Unduh
                                </a>
                            @else
                                <span>File Kosong</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>SKT</td>
                        <td class="text-center align-middle">
                            <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'skt']) }}"
                                target="_blank" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye fa-lg"></i> Lihat
                            </a>
                            <a href="{{ route('submissions.download_file', ['id' => $submission->id, 'type' => 'skt']) }}"
                                class="btn btn-success btn-sm">
                                <i class="fas fa-cloud-download-alt fa-lg"></i> Unduh
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Akta Notaris/Surat Berbadan Hukum</td>
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
                        <td>NPWP Perwakilan</td>
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
                        <td>Surat Domisili</td>
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
                        <td>Surat Keterangan Admin</td>
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
                        <td>Surat Keterangan Kelurahan</td>
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
                    <!-- Tambahkan detail lain yang diperlukan -->
                </tbody>
            </table>
        </div>
    </div>
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
