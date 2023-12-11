@extends('frontend.layouts.master')

@section('title')
    Permintaan Reset Password
@endsection

@include('frontend.components.breadcrumb')

@section('content')
<section class="fp__signup" style="background: url({{ asset('frontend/images/login_bg.jpg') }});">
    <div class="fp__signup_overlay pt_125 xs_pt_95 pb_100 xs_pb_70">
        <div class=" container">
            <div class="row wow fadeInUp" data-wow-duration="1s">
                <div class="col-xxl-5 col-xl-6 col-md-9 col-lg-7 m-auto">
                    <div class="fp__login_area">
                        <h2>Permintaan reset password</h2>
                        <p>isi email anda dibawah ini untuk mengirimkan link reset password ke email anda</p>
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="fp__login_imput">
                                        <label>email</label>
                                        <input type="email" placeholder="Email" name="email" value="{{ old('email') }}" required>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="fp__login_imput">
                                        <button type="submit" class="common_btn">Kirim Email Reset Password</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <p class="create_account"><a href="{{ route('login') }}">kembali ke halaman login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
