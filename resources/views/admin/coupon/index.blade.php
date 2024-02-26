@extends('admin.layouts.master')

@section('title')
    Kupon
@endsection

@section('content')
<div class="d-flex align-items-center mb-3">
    <h6 class="mb-0 text-uppercase">Data Kupon</h6>
    <div class="ms-auto">
        <div class="btn-group">
            <a href="{{ route('admin.coupon.create') }}" class="btn btn-primary">Tambah Data</a>
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
                        <th>Nama</th>
                        <th>Kode</th>
                        <th>Jumlah</th>
                        <th>Tipe Diskon</th>
                        <th>Diskon</th>
                        <th>Tanggal Kadaluarsa</th>
                        <th>Status</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coupon as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->discount_type }}</td>
                            <td>{{ $item->discount }}</td>
                            @php
                                \Carbon\Carbon::setLocale('id');
                            @endphp
                            <td>{{ \Carbon\Carbon::parse($item->expire_date)->translatedFormat('d F Y')}}</td>
                            @if ($item->status === 1)
                                <td><span class="badge rounded-pill bg-primary">Aktif</span></td>
                            @else
                                <td><span class="badge rounded-pill bg-danger">Tidak Aktif</span></td>
                            @endif
                            <td>
                                <a class="pe-1 btn btn-primary" href="{{ route('admin.coupon.edit', $item->id) }}"
                                    title="Edit Data"><i class="fas fa-edit"></i></a>
                                |
                                <a class="pe-2 btn btn-danger delete-item"
                                    href="{{ route('admin.coupon.destroy', $item->id) }}" title="Hapus Data"><i
                                        class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kode</th>
                        <th>Jumlah</th>
                        <th>Tipe Diskon</th>
                        <th>Diskon</th>
                        <th>Tanggal Kadaluarsa</th>
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
