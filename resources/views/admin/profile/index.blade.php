@extends('admin.layouts.master')

@section('title')
    Profil
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <h6 class="mb-0 text-uppercase">Profil Admin</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <h3>Ubah Data Profil</h3>
                        <form method="POST" class="row g-3 needs-validation" action="{{ route('admin.profile.updateProfile') }}" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{ Auth::user()->name }}" name="name" required>
                                <div class="invalid-feedback">Kolom ini harus diisi!</div>
                            </div>
                            <div class="col-md-6">
                                <label for="validationCustom02" class="form-label">Email</label>
                                <input type="email" class="form-control" id="validationCustom02" value="{{ Auth::user()->email }}" name="email" required>
                                <div class="invalid-feedback">Kolom email harus diisi dengan valid!</div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <h3>Ubah Password</h3>
                        <form class="row g-3 needs-validation" action="#" novalidate>
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">Password saat ini</label>
                                <input type="password" class="form-control" id="validationCustom01" required>
                                <div class="invalid-feedback">Kolom ini harus diisi!</div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationCustom02" class="form-label">Password baru</label>
                                <input type="password" class="form-control" id="validationCustom02" required>
                                <div class="invalid-feedback">Kolom ini harus diisi!</div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationCustom03" class="form-label">Konfirmasi password</label>
                                <input type="password" class="form-control" id="validationCustom03" required>
                                <div class="invalid-feedback">Kolom ini harus diisi!</div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Ubah Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
