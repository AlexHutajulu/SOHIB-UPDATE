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
            <ul class="nav nav-tabs" id="myTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="proses-tab" data-bs-toggle="tab" href="#proses" role="tab"
                        aria-controls="proses" aria-selected="true">Proses</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="disetujui-tab" data-bs-toggle="tab" href="#disetujui" role="tab"
                        aria-controls="disetujui" aria-selected="false">Disetujui</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="ditolak-tab" data-bs-toggle="tab" href="#ditolak" role="tab"
                        aria-controls="ditolak" aria-selected="false">Ditolak</a>
                </li>
            </ul>
            <div class="tab-content mt-2" id="myTabsContent">
                <div class="tab-pane fade show active" id="proses" role="tabpanel" aria-labelledby="proses-tab">
                    @include('admin.submission-table', ['submissions' => $newSubmissions])
                </div>
                <div class="tab-pane fade" id="disetujui" role="tabpanel" aria-labelledby="disetujui-tab">
                    @include('admin.submission-table', ['submissions' => $approvedSubmissions])
                </div>
                <div class="tab-pane fade" id="ditolak" role="tabpanel" aria-labelledby="ditolak-tab">
                    @include('admin.submission-table', ['submissions' => $rejectedSubmissions])
                </div>
            </div>
        </div>
    </div>

@endsection
