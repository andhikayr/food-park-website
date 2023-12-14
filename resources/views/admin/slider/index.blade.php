@extends('admin.layouts.master')

@section('title')
    Slider Produk Diskon
@endsection

@section('content')
    <div class="d-flex align-items-center mb-3">
        <h6 class="mb-0 text-uppercase">Data Produk Slider</h6>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="#" class="btn btn-primary">Tambah Data</a>
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
                        @foreach ($sliders as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->image }}</td>
                                <td>{{ $item->title }}</td>
                                @if ($item->status === 1)
                                    <td><span class="badge rounded-pill bg-success">Aktif</span></td>
                                @else
                                    <td><span class="badge rounded-pill bg-success">Tidak Aktif</span></td>
                                @endif

                                <td>Opsi</td>
                            </tr>
                        @endforeach
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
            $('#example').DataTable();
        });
    </script>
@endpush
