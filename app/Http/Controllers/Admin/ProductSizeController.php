<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($productId) : View
    {
        $product = Product::findOrFail($productId);
        return view('admin.product.product-size.index', compact('productId', 'product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'name' =>'required|max:255',
            'price' =>'required|numeric|max:15',
            'product_id' => 'required|integer'
        ]);

        ProductSize::create([
            'name' => $request->name,
            'price' => $request->price,
            'product_id' => $request->product_id
        ]);

        Alert::success('Berhasil', 'Varian Ukuran Produk berhasil ditambahkan');
        return to_route('admin.product-size.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
