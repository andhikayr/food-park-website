<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function index() : View {
        return view('frontend.dashboard');
    }

    public function updateDataProfile(Request $request) : RedirectResponse {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email,' . Auth::user()->id
        ]);

        $user = Auth::user();

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        Alert::success('Sukses', 'Data informasi anda telah berhasil diubah');
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

        $user = Auth::user();

        $user->update([
            'password' => $request->password
        ]);

        Alert::success('Sukses', 'Password anda telah berhasil diubah');
        return back();
    }

    public function updateAvatar(Request $request) {
        $user = Auth::user();

        if ($user->image) {
            unlink('frontend/uploads/profile_image/' . $user->image);
            $imageName = 'user_' . date('YmdHis') . '.' . $request->file('image')->extension();
            $request->file('image')->move('frontend/uploads/profile_image/', $imageName);
        } else {
            $imageName = 'user_' . date('YmdHis') . '.' . $request->file('image')->extension();
            $request->file('image')->move('frontend/uploads/profile_image/', $imageName);
        }

        $user->update([
            'image' => isset($imageName) ? $imageName : $user->image
        ]);

        Alert::success('Sukses', 'Gambar profil telah berhasil diubah');
        return response(['status' => 'success', 'message' => 'Gambar profil telah berhasil diperbarui']);
    }
}
