@extends('admin.layouts.master')

@section('title')
    Galeri Produk {{ $product->name }}
@endsection

@section('content')
    <div class="d-flex align-items-center mb-3">
        <h6 class="mb-0 text-uppercase">Galeri Produk {{ $product->name }}</h6>
        <a href="{{ route('admin.product.index') }}" class="btn btn-primary ms-auto">Kembali</a>
    </div>
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="col-12">
                <form action="{{ route('admin.product-gallery.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="col-12">
                        <label for="image" class="mb-3">Tambah Gambar Produk Galeri</label>
                        <input class="dropify-id" type="file" name="image[]" id="image" class="form-control"
                            accept="image/jpg, image/jpeg, image/png" data-show-remove="false" multiple>
                        <p id="output" class="pt-3"></p>
                        <p class="text-secondary my-3">* Ukuran gambar tidak boleh lebih dari 4 MB. Format
                            gambar yang diizinkan : JPG, JPEG, PNG</p>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($images as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td><img src="{{ asset('admin/uploads/product_image/' . $item->image) }}" width="120px"
                                        height="120px"></td>
                                <td>
                                    <a class="pe-2 btn btn-danger delete-item"
                                        href="{{ route('admin.product-gallery.destroy', $item->id) }}" title="Hapus Data"><i
                                            class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Opsi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                language: {
                    url: '{{ asset('admin/assets/plugins/datatable/id.json') }}',
                },
            });
        });

        document.querySelector('#image').addEventListener('change', function(e) {
            var fileCount = e.target.files.length;
            document.querySelector('#output').textContent = 'Total gambar yang dipilih : ' + fileCount;
        });
    </script>
@endpush
