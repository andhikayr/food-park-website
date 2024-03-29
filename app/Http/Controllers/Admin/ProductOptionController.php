<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductOption;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use RealRashid\SweetAlert\Facades\Alert;

class ProductOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'name.required' => 'Opsi produk tidak boleh kosong',
            'name.max' => 'Opsi produk tidak boleh lebih dari 255 karakter',
            'price.required' => 'Harga produk tidak boleh kosong',
            'price.numeric' => 'Harga produk harus berupa angka',
            'price.max' => 'Harga produk tidak boleh lebih dari 15 karakter'
        ]);

        ProductOption::create([
            'name' => $request->name,
            'price' => $request->price,
            'product_id' => $request->product_id
        ]);

        Alert::success('Berhasil', 'Opsi Tambahan Produk berhasil ditambahkan');
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
            'name.required' => 'Opsi produk tidak boleh kosong',
            'name.max' => 'Opsi produk tidak boleh lebih dari 255 karakter',
            'price.required' => 'Harga produk tidak boleh kosong',
            'price.numeric' => 'Harga produk harus berupa angka',
            'price.max' => 'Harga produk tidak boleh lebih dari 15 karakter'
        ]);

        $productOption = ProductOption::findOrFail($id);
        $productOption->update([
            'name' => $request->name,
            'price' => $request->price,
            'product_id' => $request->product_id
        ]);

        Alert::success('Berhasil', 'Opsi Tambahan Produk berhasil diubah');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : Response
    {
        try {
            $options = ProductOption::findOrFail($id);
            $options->delete();

            Alert::success('Sukses', 'Opsi produk ini telah berhasil dihapus');
            return response(['status' => 'success', 'message' => 'Opsi produk ini telah berhasil dihapus']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
