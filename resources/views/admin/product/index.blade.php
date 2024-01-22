@extends('admin.layouts.master')

@section('title')
    Data Produk
@endsection

@section('content')
    <div class="d-flex align-items-center mb-3">
        <h6 class="mb-0 text-uppercase">Data Produk</h6>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.product.create') }}" class="btn btn-primary">Tambah Data</a>
            </div>
        </div>
    </div>
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Thumbnail Produk</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Harga Diskon</th>
                            <th>Tampilkan di Homepage ?</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td><img src="{{ asset('admin/uploads/product_image/' . $item->thumb_image) }}"
                                        width="120px" height="120px"></td>
                                <td>{{ $item->name }}</td>
                                <td>Rp. {{ $item->price }}</td>
                                @if ($item->offer_price)
                                    <td>Rp. {{ $item->offer_price }}</td>
                                @else
                                    <td>Tidak ada</td>
                                @endif

                                @if ($item->show_at_home === 1)
                                    <td><span class="badge rounded-pill bg-primary">Ya</span></td>
                                @else
                                    <td><span class="badge rounded-pill bg-danger">Tidak</span></td>
                                @endif

                                @if ($item->status === 1)
                                    <td><span class="badge rounded-pill bg-primary">Aktif</span></td>
                                @else
                                    <td><span class="badge rounded-pill bg-danger">Tidak Aktif</span></td>
                                @endif
                                <td>
                                    <a class="pe-1 btn btn-primary" href="{{ route('admin.product.edit', $item->id) }}"
                                        title="Edit Data"><i class="fas fa-edit"></i></a>
                                    |
                                    <a class="pe-2 btn btn-danger delete-item"
                                        href="{{ route('admin.product.destroy', $item->id) }}" title="Hapus Data"><i
                                            class="fas fa-trash"></i></a>
                                    |
                                    <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false" title="Opsi Lainnya"><i class="fas fa-cog"></i></button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('admin.product-gallery.show.index', $item->id) }}">Galeri Produk</a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('admin.product-size.show.index', $item->id) }}">Varian Ukuran Produk</a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Thumbnail Produk</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Harga Diskon</th>
                            <th>Tampilkan di Homepage ?</th>
                            <th>Status</th>
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
    </script>
@endpush
