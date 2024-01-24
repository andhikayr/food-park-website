@extends('admin.layouts.master')

@section('title')
    Tambah Produk Slider
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="d-flex align-items-center mb-3">
            <h6 class="mb-0 text-uppercase">Tambah Produk Slider</h6>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('admin.slider.index') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="p-4 border rounded">
                    <form method="POST" class="row g-3" action="{{ route('admin.slider.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <label for="image" class="mb-3">Gambar Produk Slider *</label>
                            <input class="dropify-id" class="form-control" type="file" name="image" id="image"
                                accept="image/jpg, image/png, image/jpeg" data-max-file-size="1M"
                                data-allowed-file-extensions="jpg jpeg png" required>
                            <p class="text-secondary mb-0 mt-3">* Ukuran gambar tidak boleh lebih dari 1 MB. Format
                                gambar yang diizinkan : JPG, JPEG, PNG</p>
                        </div>
                        <div class="col-md-6">
                            <label for="product_offer" class="form-label">Diskon Produk (Persentase)</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="product_offer"
                                name="product_offer" min="1" max="100" value="{{ old('product_offer') }}">
                                <span class="input-group-text">%</span>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <label for="title" class="form-label">Judul *</label>
                            <input type="text" class="form-control" id="title"
                                name="title" required maxlength="255" value="{{ old('title') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="sub_title" class="form-label">Sub Judul *</label>
                            <input type="text" class="form-control" id="sub_title"
                                name="sub_title" required maxlength="255" value="{{ old('sub_title') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="button_link" class="form-label">Link Produk</label>
                            <input type="text" class="form-control" id="button_link"
                                name="button_link" maxlength="255" value="{{ old('button_link') }}">
                        </div>
                        <div class="col-12">
                            <label for="short_description" class="form-label">Deskripsi Singkat *</label>
                            <input type="text" class="form-control" id="short_description"
                                name="short_description" required maxlength="255"  value="{{ old('short_description') }}">
                        </div>
                        <div class="col-12">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                            <p class="mt-3 text-secondary">* kolom status digunakan untuk mengatur apakah produk ini muncul di homepage slider atau tidak</p>
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
