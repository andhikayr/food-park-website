<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductSize;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use RealRashid\SweetAlert\Facades\Alert;

class ProductSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($productId) : View
    {
        $product = Product::findOrFail($productId);
        $sizes = ProductSize::where('product_id', $product->id)->get();
        $options = ProductOption::where('product_id', $product->id)->get();
        return view('admin.product.product-size.index', compact('sizes', 'product', 'options'));
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
            'price' =>'required|numeric',
            'product_id' => 'required|integer'
        ],[
            'name.required' => 'Varian ukuran produk tidak boleh kosong',
            'name.max' => 'Varian ukuran produk tidak boleh lebih dari 255 karakter',
            'price.required' => 'Harga ukuran produk tidak boleh kosong',
            'price.numeric' => 'Harga ukuran produk harus berupa angka',
        ]);

        ProductSize::create([
            'name' => $request->name,
            'price' => $request->price,
            'product_id' => $request->product_id
        ]);

        Alert::success('Berhasil', 'Varian Ukuran Produk berhasil ditambahkan');
        return back();
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' =>'required|max:255',
            'price' =>'required|numeric',
            'product_id' => 'required|integer'
        ],[
            'name.required' => 'Varian ukuran produk tidak boleh kosong',
            'name.max' => 'Varian ukuran produk tidak boleh lebih dari 255 karakter',
            'price.required' => 'Harga ukuran produk tidak boleh kosong',
            'price.numeric' => 'Harga ukuran produk harus berupa angka',
        ]);

        $productSize = ProductSize::findOrFail($id);
        $productSize->update([
            'name' => $request->name,
            'price' => $request->price,
            'product_id' => $request->product_id
        ]);

        Alert::success('Berhasil', 'Varian Ukuran Produk berhasil diubah');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : Response
    {
        try {
            $product = ProductSize::findOrFail($id);
            $product->delete();

            Alert::success('Sukses', 'Varian ukuran produk ini telah berhasil dihapus');
            return response(['status' => 'success', 'message' => 'Varian ukuran produk ini telah berhasil dihapus']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
