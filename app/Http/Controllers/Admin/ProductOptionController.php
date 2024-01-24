<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required|max:255',
            'price' =>'required|numeric|max:15',
            'product_id' => 'required|integer'
        ],[
            'name.required' => 'Opsi produk tidak boleh kosong',
            'name.max' => 'Opsi produk tidak boleh lebih dari 255 karakter',
            'price.required' => 'Harga produk tidak boleh kosong',
            'price.numeric' => 'Harga produk harus berupa angka',
            'price.max' => 'Harga produk tidak boleh lebih dari 15 karakter'
        ]);
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
