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
                        <form method="POST" class="row g-3 needs-validation"
                            action="{{ route('admin.profile.updateProfile') }}" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="validationCustom01"
                                    value="{{ Auth::user()->name }}" name="name" required>
                                <div class="invalid-feedback">Kolom ini harus diisi!</div>
                            </div>
                            <div class="col-md-6">
                                <label for="validationCustom02" class="form-label">Email</label>
                                <input type="email" class="form-control" id="validationCustom02"
                                    value="{{ Auth::user()->email }}" name="email" required>
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
                                        name="current_password">
                                    <span class="input-group-text" id="togglePassword1" onclick="togglePassword1"><i
                                            id="togglePasswordIcon1" class="fas fa-eye"></i></span>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <label for="password" class="form-label">Password baru</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" required name="password"
                                        oninput="password">
                                    <span class="input-group-text" id="togglePassword2" onclick="togglePassword2"><i
                                            id="togglePasswordIcon2" class="fas fa-eye"></i></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="password_confirmation" class="form-label">Konfirmasi password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password_confirmation" required
                                    name="password_confirmation">
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

        window.onload = function() {
            var password1 = document.getElementById("current_password");
            var togglePassword1 = document.getElementById("togglePassword1");
            var togglePasswordIcon1 = document.getElementById("togglePasswordIcon1");

            var password2 = document.getElementById("password");
            var togglePassword2 = document.getElementById("togglePassword2");
            var togglePasswordIcon2 = document.getElementById("togglePasswordIcon2");

            var password3 = document.getElementById("password_confirmation");
            var togglePassword3 = document.getElementById("togglePassword3");
            var togglePasswordIcon3 = document.getElementById("togglePasswordIcon3");

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
