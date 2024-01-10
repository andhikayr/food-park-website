@extends('admin.layouts.master')

@section('title')
    Tambah Kategori Produk
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h6 class="mb-0 text-uppercase">Tambah Kategori Produk</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="p-4 border rounded">
                    <form method="POST" class="row g-3" action="{{ route('admin.product-category.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <label for="name" class="form-label">Nama Kategori Produk *</label>
                            <input type="text" class="form-control" id="name"
                                name="name" required maxlength="255">
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                            <p class="mt-3 text-secondary">* kolom status digunakan untuk mengatur apakah kategori produk ini muncul atau tidak</p>
                        </div>
                        <div class="col-md-6">
                            <label for="show_at_home" class="form-label">Tampilkan di Home</label>
                            <select name="show_at_home" id="show_at_home" class="form-select">
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
