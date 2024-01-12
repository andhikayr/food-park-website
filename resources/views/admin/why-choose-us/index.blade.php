@extends('admin.layouts.master')

@section('title')
    Bagian "Mengapa Memilih Kita"
@endsection

@section('content')
    <h6 class="mb-4 mt-2 text-uppercase">"Mengapa Memilih Kita"</h6>
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Ubah atau tambah bagian judul "Mengapa Memilih Kita"
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample" style="">
                        <div class="accordion-body">
                            <form action="{{ route('admin.why-choose-title.update') }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group py-2">
                                    <label for="why_choose_top_title">Top Judul</label>
                                    <input type="text" name="why_choose_top_title" id="why_choose_top_title" class="form-control" value="{{ @$titles['why_choose_top_title'] }}" maxlength="255">
                                </div>
                                <div class="form-group py-2">
                                    <label for="why_choose_main_title">Judul</label>
                                    <input type="text" name="why_choose_main_title" id="why_choose_main_title" class="form-control" value="{{ @$titles['why_choose_main_title'] }}" maxlength="255">
                                </div>
                                <div class="form-group py-2">
                                    <label for="why_choose_sub_title">Sub Judul</label>
                                    <input type="text" name="why_choose_sub_title" id="why_choose_sub_title" class="form-control" value="{{ @$titles['why_choose_sub_title'] }}" maxlength="255">
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center my-2">
                <h6 class="mb-0 text-uppercase">Semua Data</h6>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('admin.why-choose-us.create') }}" class="btn btn-primary">Tambah Data</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Ikon</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($WhyChooseUs as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td><i class="{{ $item->icon }} ms-2 mt-2" style="transform: scale(2)"></i></td>
                                <td>{{ $item->title }}</td>
                                @if ($item->status === 1)
                                    <td><span class="badge rounded-pill bg-primary">Aktif</span></td>
                                @else
                                    <td><span class="badge rounded-pill bg-danger">Tidak Aktif</span></td>
                                @endif
                                <td>
                                    <a class="pe-1 btn btn-primary" href="{{ route('admin.why-choose-us.edit', $item->id) }}"
                                        title="Edit Data"><i class="fas fa-edit"></i></a>
                                    |
                                    <a class="pe-2 btn btn-danger delete-item"
                                        href="{{ route('admin.why-choose-us.destroy', $item->id) }}" title="Hapus Data"><i
                                            class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Ikon</th>
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
                    url: '{{ asset('admin/assets/plugins/datatable/id.json') }}',
                },
            });
        });
    </script>
@endpush
