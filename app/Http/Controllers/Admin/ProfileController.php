<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function index() : View {
        return view('admin.profile.index');
    }

    public function updateProfile(Request $request) : RedirectResponse {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email'
        ]);

        $admin = Auth::user();

        $admin->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        Alert::success('Sukses', 'Data profil telah berhasil diubah');
        return back();
    }

    public function updatePassword(Request $request) : RedirectResponse {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|min:8|confirmed'
        ],[
            'current_password.current_password' => 'Password saat ini yang anda input salah',
            'password.confirmed' => 'Password baru dengan konfirmasi password tidak cocok'
        ]);

        $admin = Auth::user();

        $admin->update([
            'password' => Hash::make($request->password)
        ]);

        Alert::success('Sukses', 'Password anda telah berhasil diubah');
        return back();
    }
}
