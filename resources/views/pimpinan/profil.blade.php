@extends('layouts.pimpinan')

@section('title', 'SOHIB | Sistem Online Hibah Banjarbaru')

@section('content')

    <section class="profile-section">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4 shadow card-custom">
                        <div class="card-body text-center">
                            <img src="{{ $avatar }}" alt="{{ $user->name }}"
                                class="rounded-circle img-fluid profile-img mb-3">
                            <h5 class="my-3">{{ $user->name }}</h5>
                            <p class="text-muted mb-1">{{ $user->nik }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4 shadow card-custom">
                        <div class="card-body">
                            <form action="{{ route('update_profil') }}" method="POST">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="nik" name="nik" value="{{ $user->nik }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="name" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="name" name="name" value="{{ $user->name }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-plaintext email-display">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4 shadow card-custom">
                                <!-- Additional content can be placed here -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-4 shadow card-custom">
                                <!-- Additional content can be placed here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@push('scripts')
    <!-- Add any specific scripts for this page here -->
@endpush
