@extends('admin.layouts.master')

@section('title')
    Profil
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <h6 class="mb-0 text-uppercase">Profil Admin</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <h3>Ubah Data Profil</h3>
                        <form method="POST" class="row g-3" action="{{ route('admin.profile.updateProfile') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-12">
                                <label for="image" class="mb-3">Gambar Profil</label>
                                <input class="dropify-id" class="form-control" type="file" name="image" id="image"
                                    accept="image/jpg, image/png, image/jpeg" data-max-file-size="1M"
                                    data-allowed-file-extensions="jpg jpeg png"
                                    data-default-file="{{ asset('admin/uploads/profile_image/' . Auth::user()->image) }}">
                                <p class="text-secondary mb-0 mt-3">* Ukuran gambar tidak boleh lebih dari 1 MB. Format
                                    gambar yang diizinkan : JPG, JPEG, PNG</p>

                            </div>
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}"
                                    name="name" required>
                                <div class="invalid-feedback">Kolom ini harus diisi!</div>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}"
                                    name="email" required>
                                <div class="invalid-feedback">Kolom email harus diisi dengan valid!</div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="p-4 border rounded">
                        <h3>Ubah Password</h3>
                        <form method="POST" class="row g-3" action="{{ route('admin.profile.updatePassword') }}">
                            @csrf
                            @method('PUT')
                            <div class="col-md-4">
                                <label for="current_password" class="form-label">Password saat ini</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="current_password" required
                                        name="current_password" minlength="8">
                                    <span class="input-group-text" id="togglePassword1" onclick="togglePassword1"><i
                                            id="togglePasswordIcon1" class="fas fa-eye"></i></span>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <label for="password" class="form-label">Password baru</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" required name="password"
                                        oninput="password" minlength="8">
                                    <span class="input-group-text" id="togglePassword2" onclick="togglePassword2"><i
                                            id="togglePasswordIcon2" class="fas fa-eye"></i></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="password_confirmation" class="form-label">Konfirmasi password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password_confirmation" required
                                        name="password_confirmation" minlength="8">
                                    <span class="input-group-text" id="togglePassword3" onclick="togglePassword3"><i
                                            id="togglePasswordIcon3" class="fas fa-eye"></i></span>
                                </div>

                            </div>
                            <p class="text-danger mb-0">* Panjang password baru minimal 8 karakter</p>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Ubah Password</button>
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
        // Toggle ikon show / hide password
        window.onload = function() {
            let password1 = document.getElementById("current_password");
            let togglePassword1 = document.getElementById("togglePassword1");
            let togglePasswordIcon1 = document.getElementById("togglePasswordIcon1");

            let password2 = document.getElementById("password");
            let togglePassword2 = document.getElementById("togglePassword2");
            let togglePasswordIcon2 = document.getElementById("togglePasswordIcon2");

            let password3 = document.getElementById("password_confirmation");
            let togglePassword3 = document.getElementById("togglePassword3");
            let togglePasswordIcon3 = document.getElementById("togglePasswordIcon3");

            togglePassword1.addEventListener('click', function() {
                togglePassword(password1, togglePasswordIcon1);
            });

            togglePassword2.addEventListener('click', function() {
                togglePassword(password2, togglePasswordIcon2);
            });

            togglePassword3.addEventListener('click', function() {
                togglePassword(password3, togglePasswordIcon3);
            });
        };

        function togglePassword(passwordField, toggleButton) {
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleButton.classList.remove("fa-eye");
                toggleButton.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                toggleButton.classList.remove("fa-eye-slash");
                toggleButton.classList.add("fa-eye");
            }
        }
    </script>
@endpush
