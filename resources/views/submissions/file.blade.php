@extends('layouts.masyarakat')

@section('title', 'File Masyarakat')

@section('content')
    <h1 class="mt-4">{{ $submission->name }}</h1>
    <form action="{{ route('submissions.file', $submission->id) }}" method="post" enctype="multipart/form-data" class="row g-2">
        <div class="table-responsive">
            <table id="datatablesSimple" class="table table-bordered table-striped">
                <tr>
                    <thead>
                        <th>Surat Pengantar</th>
                        <th>Foto Tempat Ibadah</th>
                        <th>Akta Tanah</th>
                        <th>Barang Yang Diperlukan</th>
                        <th>SK kepengurusan</th>
                        <th>SKT</th>
                        <th>Akta Notaris/Surat Berbadan Hukum</th>
                        <th>NPWP Perwakilan</th>
                        <th>Surat Domisili</th>
                        <th>Surat Keputusan dari Admin</th>
                        <th>Status</th>
                    </thead>
                </tr>
                <tr>
                    <tbody>
                        <td style="text-align: center; vertical-align: middle;">
                            <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'application_letter']) }}" target="_blank">
                                <i class="fa-solid fa-cloud-arrow-down fa-lg" style="color: #00db25;"></i>
                            </a>
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'documentation']) }}" target="_blank">
                                <i class="fa-solid fa-cloud-arrow-down fa-lg" style="color: #00db25;"></i>
                            </a>  
                            </a>
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'tanah']) }}" target="_blank">
                                <i class="fa-solid fa-cloud-arrow-down fa-lg" style="color: #00db25;"></i>
                            </a>
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'rab']) }}" target="_blank">
                                <i class="fa-solid fa-cloud-arrow-down fa-lg" style="color: #00db25;"></i>
                            </a>
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'land_certificate']) }}" target="_blank">
                                <i class="fa-solid fa-cloud-arrow-down fa-lg" style="color: #00db25;"></i>
                            </a>
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            @if($submission->management_letter)
                                <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'management_letter']) }}" target="_blank">
                                    <i class="fa-solid fa-cloud-arrow-down fa-lg" style="color: #00db25;"></i>
                                </a>
                            @else
                                File Kosong
                            @endif
                        </td>
                        
                        <td style="text-align: center; vertical-align: middle;">
                            @if($submission->notaris)
                                <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'notaris']) }}" target="_blank">
                                    <i class="fa-solid fa-cloud-arrow-down fa-lg" style="color: #00db25;"></i>
                                </a>
                            @else
                                File Kosong
                            @endif
                        </td>                        
                        <td style="text-align: center; vertical-align: middle;">
                            <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'npwp']) }}" target="_blank">
                                <i class="fa-solid fa-cloud-arrow-down fa-lg" style="color: #00db25;"></i>
                            </a>
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'domicile_letter']) }}" target="_blank">
                                <i class="fa-solid fa-cloud-arrow-down fa-lg" style="color: #00db25;"></i>
                            </a>
                        </td>
                        <td class="text-center align-middle">
                            @if($submission->sk_file)
                                <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'sk_file']) }}" target="_blank">
                                    <i class="fa-solid fa-cloud-arrow-down fa-lg" style="color: #00db25;"></i>
                                </a>
                            @else
                                File Kosong
                            @endif
                        </td>
                        <td>{{ $submission->status ?? 'NULL' }}</td>
                    </tbody>
                </tr>
            </table>
        </div>
    </form>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/table.css') }}">
@endsection
