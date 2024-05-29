@extends('layouts.masyarakat')

@section('title', 'SOHIB | Sistem Online Hibah Banjarbaru')

@section('content')

<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="{{ $avatar }}" alt="{{ $user->name }}"  class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-3">{{ $user->name }}</h5>
                        <p class="text-muted mb-1">{{ $user->nik }}</p>
                    </div>
                </div>
                <div class="card mb-4 mb-lg-0">
                    <div class="card-body p-0">
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                      <form action="{{ route('update_profil') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="nik">Nik</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="nik" name="nik" value="{{ $user->nik }}" class="form-control">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="name">Nama</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $user->email }}</p>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4 mb-md-0">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-4 mb-md-0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
