@extends('admin.layouts.master')

@section('title')
    Opsi Tambahan Produk {{ $product->name }}
@endsection

@section('content')
    <div class="d-flex align-items-center mb-3">
        <h6 class="mb-0 text-uppercase">Opsi Tambahan Produk {{ $product->name }}</h6>
        <a href="{{ route('admin.product.index') }}" class="btn btn-primary ms-auto">Kembali</a>
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="col-12">
                        <h4 class="mb-4">Tambah Varian Ukuran Produk</h4>
                        <form action="{{ route('admin.product-size.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="mb-3">Varian Ukuran Produk</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        maxlength="255">
                                </div>
                                <div class="col-md-6">
                                    <label for="price" class="mb-3">Harga</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                        <input type="text" name="price" id="price" class="form-control"
                                            maxlength="15" value="0">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">Varian Ukuran Produk {{ $product->name }}</h4>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Varian</th>
                                    <th>Harga</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sizes as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>Rp. {{ $item->price }}</td>
                                        <td>
                                            <a class="pe-2 btn btn-danger delete-item"
                                                href="{{ route('admin.product-size.destroy', $item->id) }}"
                                                title="Hapus Data"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Varian</th>
                                    <th>Harga</th>
                                    <th>Opsi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="col-12">
                        <h4 class="mb-4">Tambah Opsi Produk</h4>
                        <form action="{{ route('admin.product-option.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="mb-3">Opsi Produk</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        maxlength="255">
                                </div>
                                <div class="col-md-6">
                                    <label for="price" class="mb-3">Harga</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                        <input type="text" name="price" id="price-2" class="form-control"
                                            maxlength="15" value="0">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">Opsi Produk {{ $product->name }}</h4>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Opsi</th>
                                    <th>Harga</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($options as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>Rp. {{ $item->price }}</td>
                                        <td>
                                            <a class="pe-2 btn btn-danger delete-item"
                                                href="{{ route('admin.product-option.destroy', $item->id) }}"
                                                title="Hapus Data"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Opsi</th>
                                    <th>Harga</th>
                                    <th>Opsi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
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

        // function penambah titik pada kolom harga
        function formatRupiah(angka) {
            var rupiah = '';
            var angkarev = angka.toString().split('').reverse().join('');
            for (var i = 0; i < angkarev.length; i++)
                if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
            return rupiah.split('', rupiah.length - 1).reverse().join('');
        }

        $('#price').keyup(function() {
            var num = $(this).val().replace(/\./g, '');
            $(this).val(formatRupiah(num));
        });

        $('#price-2').keyup(function() {
            var num = $(this).val().replace(/\./g, '');
            $(this).val(formatRupiah(num));
        });
    </script>
@endpush
