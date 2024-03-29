@extends('admin.layouts.master')

@section('title')
    Tambah Produk
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h6 class="mb-0 text-uppercase">Tambah Produk</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <form method="POST" class="row g-3" action="{{ route('admin.product.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="image" class="mb-3">Gambar Produk Thumbnail *</label>
                                <input class="dropify-id" type="file" name="thumb_image" id="thumb_image"
                                    class="form-control" data-max-file-size="1M" data-allowed-file-extensions="jpg jpeg png"
                                    accept="image/jpg, image/png, image/jpeg" required>
                                <p class="text-danger mt-3 mb-0">*Gambar tidak boleh lebih dari 1024 KB (1 MB)</p>
                            </div>
                            <div class="col-12">
                                <label for="name" class="form-label">Nama Produk *</label>
                                <input type="text" class="form-control" id="name" name="name" required
                                    maxlength="255" value="{{ old('name') }}">
                            </div>
                            <div class="col-12">
                                <label for="category_id">Kategori Produk *</label>
                                <select name="category_id" id="category_id" class="single-select" required>
                                    <option value="">--- Pilih Kategori ---</option>
                                    @foreach ($kategoriProduk as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="price" class="form-label">Harga Produk *</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                    <input type="text" class="form-control" id="price" name="price" required
                                        maxlength="15" value="{{ old('price') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="offer_price" class="form-label">Harga Produk Diskon</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                    <input type="text" class="form-control" id="offer_price" name="offer_price"
                                        maxlength="15" value="{{ old('offer_price') }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="quantity" class="form-label">Jumlah *</label>
                                <input type="text" class="form-control" id="quantity" name="quantity"
                                    required maxlength="11" value="{{ old('quantity') }}">
                            </div>
                            <div class="col-12">
                                <label for="short_description" class="form-label">Deskripsi Singkat *</label>
                                <input type="text" class="form-control" id="short_description" name="short_description"
                                    required maxlength="255" value="{{ old('short_description') }}">
                            </div>
                            <!-- Create the editor container -->
                            <div class="col-12">
                                <label for="long_description" class="form-label">Deskripsi Lengkap</label>
                                <textarea name="long_description" id="summernote"> {{ old('long_description') }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="show_at_home" class="form-label">Tampilkan di Homepage</label>
                                <select name="show_at_home" id="show_at_home" class="form-select">
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                                <p class="mt-3 text-secondary">* kolom status digunakan untuk mengatur apakah produk ini
                                    muncul atau tidak</p>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        // summernote
        $('#summernote').summernote({
            placeholder: 'Ketik sesuatu disini...',
            tabsize: 2,
            height: 400
        });

        // select2
        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    </script>
@endpush
