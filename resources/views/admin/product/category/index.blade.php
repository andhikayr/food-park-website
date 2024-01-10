@extends('admin.layouts.master')

@section('title')
    Kategori Produk
@endsection

@section('content')
    <div class="d-flex align-items-center mb-3">
        <h6 class="mb-0 text-uppercase">Kategori Produk</h6>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.product-category.create') }}" class="btn btn-primary">Tambah Data</a>
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
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Judul</th>
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
                    url: '{{ asset("admin/assets/plugins/datatable/id.json") }}',
                },
            });
        });
    </script>
@endpush
