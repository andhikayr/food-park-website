<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() : View {
        return view('admin.index');
    }

    public function login() : View {
        return view('admin.login');
    }
}
