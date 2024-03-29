@extends('admin.layouts.master')

@section('title')
    Edit Bagian "Mengapa Memilih Kita"
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex align-items-center mb-3">
                <h6 class="mb-0 text-uppercase">Edit Bagian "Mengapa Memilih Kita"</h6>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('admin.why-choose-us.index') }}" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
            <hr />
            <div class="card">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <form method="POST" class="row g-3" action="{{ route('admin.why-choose-us.update', $WhyChooseUs->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="col-md-6">
                                <label for="GetIconPicker" class="form-label">Ikon</label>
                                <br>
                                <div class="ms-3" data-toggle="tooltip" title="" data-original-title="Preview of selected Icon">
                                    <i id="GetIconPicker" class="{{ $WhyChooseUs->icon }}" style="transform: scale(2.5)"></i>
                                </div>
                                <button type="button" id="GetIconPicker" data-iconpicker-input="input#GetIconPicker"
                                    data-iconpicker-preview="i#GetIconPicker" name="icon" class="btn btn-primary mt-3">Pilih Ikon</button>
                                <input type="hidden" id="GetIconPicker" name="icon" required placeholder="Hidden etc. input for icon classname" autocomplete="off" spellcheck="false" value="{{ $WhyChooseUs->icon }}">
                            </div>
                            <div class="col-md-6">
                                <label for="title" class="form-label">Judul *</label>
                                <input type="text" class="form-control" id="title" name="title" required
                                    maxlength="30" value="{{ $WhyChooseUs->title }}">
                            </div>
                            <div class="col-md-6">
                                <label for="short_description" class="form-label">Deskripsi Singkat *</label>
                                <input type="text" class="form-control" id="short_description" name="short_description" maxlength="100" value="{{ $WhyChooseUs->short_description }}">
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="1" @selected($WhyChooseUs->status === 1)>Ya</option>
                                    <option value="0" @selected($WhyChooseUs->status === 0)>Tidak</option>
                                </select>
                                <p class="mt-3 text-secondary">* kolom status digunakan untuk mengatur apakah data ini
                                    muncul di bagian "Mengapa Memilih Kita" atau tidak</p>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        // Default options
        IconPicker.Init({
            jsonUrl: '{{ asset("plugins/IconPicker/iconpicker-1.5.0.json") }}',
            searchPlaceholder: 'Cari Ikon',
            showAllButton: 'Tampilkan Semua',
            cancelButton: 'Batal',
            noResultsFound: 'Tidak ada ikon yang ditemukan.',
            borderRadius: '20px',
        });
        // Select your Button element (ID or Class)
        IconPicker.Run('#GetIconPicker');
    </script>
@endpush
