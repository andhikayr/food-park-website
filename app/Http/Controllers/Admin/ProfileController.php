<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
}
