@extends('admin.layouts.master')

@section('title')
    Pengaturan Frontend
@endsection

@section('content')
<div class="d-flex align-items-center mb-3">
    <h6 class="mb-0 text-uppercase">Pengaturan Frontend</h6>
</div>
<hr />
<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs nav-primary" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" data-bs-toggle="tab" href="#general-setting" role="tab" aria-selected="true">
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><i class="bx bx-cog font-18 me-1"></i>
                        </div>
                        <div class="tab-title">Pengaturan Umum</div>
                    </div>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="false">
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><i class="bx bx-user-pin font-18 me-1"></i>
                        </div>
                        <div class="tab-title">Profile</div>
                    </div>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#primarycontact" role="tab" aria-selected="false">
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><i class="bx bx-microphone font-18 me-1"></i>
                        </div>
                        <div class="tab-title">Contact</div>
                    </div>
                </a>
            </li>
        </ul>
        <div class="tab-content py-3">
            <div class="tab-pane fade active show" id="general-setting" role="tabpanel">
                <form action="{{ route('admin.setting.updateGeneralSetting') }}" method="post" class="row g-3">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="site_name">Nama Situs</label>
                        <input type="text" name="site_name" id="site_name" class="form-control" value="{{ config('settings.site_name') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="site_default_currency">Mata Uang Default</label>
                        <select name="site_default_currency" id="site_default_currency" class="single-select">
                            <option value="IDR">IDR</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="site_currency_icon">Ikon Mata Uang</label>
                            <input type="text" name="site_currency_icon" id="site_currency_icon" class="form-control" maxlength="4" value="{{ config('settings.site_currency_icon') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="site_currency_icon_position">Posisi Ikon Mata Uang</label>
                            <select name="site_currency_icon_position" id="site_currency_icon_position" class="single-select">
                                <option @selected(config('settings.site_currency_icon_position') === 'Kiri') value="Kiri">Kiri</option>
                                <option @selected(config('settings.site_currency_icon_position') === 'Kanan') value="Kanan">Kanan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="primaryprofile" role="tabpanel">
                <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
            </div>
            <div class="tab-pane fade" id="primarycontact" role="tabpanel">
                <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        // select2
        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    </script>
@endpush
