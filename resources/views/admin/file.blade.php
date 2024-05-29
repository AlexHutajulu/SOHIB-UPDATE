@extends('layouts.app')

@section('title', 'File Masyarakat')

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- DataTables JavaScript -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

@section('content')
    <h1 class="mt-4">{{ $submission->name }}</h1>
    <form action="{{ route('admin.file', $submission->id) }}" method="post" enctype="multipart/form-data" class="row g-2">
        <div class="container mt-4">
        <table id="example" class="table table-striped table-bordered">
            <thead>
                <tr>
                <th>Surat Pengantar</th>
                <th>Foto Tempat Ibadah</th>
                <th>Akta Tanah</th>
                <th>Barang Yang Diperlukan</th>
                <th>SK kepengurusan</th>
                <th>SKT</th>
                <th>Akta Notaris/Surat Berbadan Hukum</th>
                <th>NPWP Perwakilan</th>
                <th>Surat Domisili</th>
                <th>SK</th>
                <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center align-middle">
                        <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'application_letter']) }}" target="_blank">
                            <i class="fa-solid fa-cloud-arrow-down fa-lg" style="color: #00db25;"></i>
                        </a>
                    </td>
                    
                    <td class="text-center align-middle">
                        <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'documentation']) }}" target="_blank">
                            <i class="fa-solid fa-cloud-arrow-down fa-lg" style="color: #00db25;"></i>
                        </a>
                    </td>
                    <td class="text-center align-middle">
                        <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'tanah']) }}" target="_blank">
                            <i class="fa-solid fa-cloud-arrow-down fa-lg" style="color: #00db25;"></i>
                        </a>
                    </td>
                    <td class="text-center align-middle">
                        <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'rab']) }}" target="_blank">
                            <i class="fa-solid fa-cloud-arrow-down fa-lg" style="color: #00db25;"></i>
                        </a>
                    </td>
                    <td class="text-center align-middle">
                        <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'land_certificate']) }}" target="_blank">
                            <i class="fa-solid fa-cloud-arrow-down fa-lg" style="color: #00db25;"></i>
                        </a>
                    </td>
                    <td class="text-center align-middle">
                        @if($submission->management_letter)
                            <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'management_letter']) }}" target="_blank">
                                <i class="fa-solid fa-cloud-arrow-down fa-lg" style="color: #00db25;"></i>
                            </a>
                        @else
                            File Kosong
                        @endif
                    </td>
                    
                    <td class="text-center align-middle">
                        @if($submission->notaris)
                            <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'notaris']) }}" target="_blank">
                                <i class="fa-solid fa-cloud-arrow-down fa-lg" style="color: #00db25;"></i>
                            </a>
                        @else
                            File Kosong
                        @endif
                    </td>                        
                    <td class="text-center align-middle">
                        <a href="{{ route('submissions.show_file', ['id' => $submission->id, 'type' => 'npwp']) }}" target="_blank">
                            <i class="fa-solid fa-cloud-arrow-down fa-lg" style="color: #00db25;"></i>
                        </a>
                    </td>
                    <td class="text-center align-middle">
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
                    <td class="align-middle">{{ $submission->status ?? 'NULL' }}</td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function () {
            $('#fileTable').DataTable({
                "lengthChange": false // Menonaktifkan opsi "Show [jumlah] entries"
            });
        });
    </script>    
    </form>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/table.css') }}">
@endsection
