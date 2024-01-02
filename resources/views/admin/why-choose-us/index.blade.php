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
                            Bagian Judul "Mengapa Memilih Kita"
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample" style="">
                        <div class="accordion-body">
                            <form action="#" method="post">
                                <div class="form-group py-2">
                                    <label for="">Top Judul</label>
                                    <input type="text" name="" id="" class="form-control">
                                </div>
                                <div class="form-group py-2">
                                    <label for="title">Judul</label>
                                    <input type="text" name="title" id="title" class="form-control">
                                </div>
                                <div class="form-group py-2">
                                    <label for="sub_title">Sub Judul</label>
                                    <input type="text" name="sub_title" id="sub_title" class="form-control">
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
                    url: '{{ asset('admin/assets/plugins/datatable/id.json') }}',
                },
            });
        });
    </script>
@endpush
