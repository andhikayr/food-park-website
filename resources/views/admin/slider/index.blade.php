@extends('admin.layouts.master')

@section('title')
    Slider Produk Diskon
@endsection

@section('content')
    <div class="d-flex align-items-center mb-3">
        <h6 class="mb-0 text-uppercase">Data Produk Slider</h6>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.slider.create') }}" class="btn btn-primary">Tambah Data</a>
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
                                <td><img src="{{ asset('admin/uploads/slider_image/' . $item->image) }}" width="120px" height="120px"></td>
                                <td>{{ $item->title }}</td>
                                @if ($item->status === 1)
                                    <td><span class="badge rounded-pill bg-primary">Aktif</span></td>
                                @else
                                    <td><span class="badge rounded-pill bg-danger">Tidak Aktif</span></td>
                                @endif
                                <td>
                                    <a class="pe-1 btn btn-primary" href="{{ route('admin.slider.edit', $item->id) }}"
                                        title="Edit Data"><i class="fas fa-edit"></i></a>
                                    |
                                    <a class="pe-2 btn btn-danger delete-item"
                                        href="{{ route('admin.slider.destroy', $item->id) }}" title="Hapus Data"><i
                                            class="fas fa-trash"></i></a>
                                </td>
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
            $('#example').DataTable({
                language: {
                    url: '{{ asset("admin/assets/plugins/datatable/id.json") }}',
                },
            });
        });
    </script>
@endpush
