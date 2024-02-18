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
                                    <input type="text" name="name" id="name" class="form-control" maxlength="255"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="price" class="mb-3">Harga</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                        <input type="text" name="price" id="price" class="form-control"
                                            maxlength="15" value="0" required>
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
                                        <td>Rp. {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary pe-2" data-bs-toggle="modal"
                                                data-bs-target="#itemModal{{ $item->id }}" title="Edit Data">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <a class="pe-2 btn btn-danger delete-item"
                                                href="{{ route('admin.product-size.destroy', $item->id) }}"
                                                title="Hapus Data"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="itemModal{{ $item->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="itemModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="itemModalLabel">Edit Varian Ukuran Produk
                                                        {{ $product->name }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.product-size.update', $item->id) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                                        <div class="form-group">
                                                            <label for="name" class="mb-3">Varian Ukuran
                                                                Produk</label>
                                                            <input type="text" name="name" id="name"
                                                                class="form-control" maxlength="255" required value="{{ $item->name }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="price" class="my-3">Harga</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"
                                                                    id="inputGroupPrepend">Rp.</span>
                                                                <input type="text" name="price" id="price"
                                                                    class="form-control" maxlength="15" required value="{{ $item->price }}">
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                        maxlength="255" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="price" class="mb-3">Harga</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                        <input type="text" name="price" id="price" class="form-control"
                                            maxlength="15" value="0" required>
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
                        <table id="example2" class="table table-striped table-bordered" style="width:100%">
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
                                        <td>Rp. {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary pe-2" data-bs-toggle="modal"
                                                data-bs-target="#itemModal2{{ $item->id }}" title="Edit Data">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <a class="pe-2 btn btn-danger delete-item"
                                                href="{{ route('admin.product-option.destroy', $item->id) }}"
                                                title="Hapus Data"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="itemModal2{{ $item->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="itemModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="itemModalLabel">Edit Opsi Produk
                                                        {{ $product->name }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.product-option.update', $item->id) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                                        <div class="form-group">
                                                            <label for="name" class="mb-3">Opsi
                                                                Produk</label>
                                                            <input type="text" name="name" id="name"
                                                                class="form-control" maxlength="255" required value="{{ $item->name }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="price" class="my-3">Harga</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"
                                                                    id="inputGroupPrepend">Rp.</span>
                                                                <input type="text" name="price" id="price"
                                                                    class="form-control" maxlength="15" required value="{{ $item->price }}">
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

        $(document).ready(function() {
            $('#example2').DataTable({
                language: {
                    url: '{{ asset('admin/assets/plugins/datatable/id.json') }}',
                },
            });
        });
    </script>
@endpush
