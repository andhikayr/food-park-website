<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $coupon = Coupon::all();
        return view('admin.coupon.index', compact('coupon'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponRequest $request) : RedirectResponse
    {
        $couponData = $request->validated();

        Coupon::create($couponData);

        Alert::success('Berhasil', 'Kupon berhasil ditambahkan');
        return to_route('admin.coupon.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CouponRequest $request, string $id)
    {
        $couponUpdate = Coupon::findOrFail($id);
        $couponData = $request->validated();

        $couponUpdate->update($couponData);

        Alert::success('Berhasil', 'Kupon berhasil diubah');
        return to_route('admin.coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $coupon = Coupon::findOrFail($id);
            $coupon->delete();

            Alert::success('Berhasil', 'Kupon berhasil dihapus');
            return response(['status' => 'success', 'message' => 'Kupon berhasil dihapus']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
