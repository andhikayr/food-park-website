<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductGallery;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($productId): View
    {
        $images = ProductGallery::where('product_id', $productId)->get();
        return view('admin.product.gallery.index', compact('productId', 'images'));
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
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image.*' => 'required|image|mimes:png,jpg,jpeg|max:4096',
            'product_id' => 'required|integer'
        ]);

        foreach ($request->file('image') as $image) {
            $imageName = 'product_img_detail_' . uniqid() . '.' . $image->extension();
            $image->move('admin/uploads/product_image', $imageName);

            ProductGallery::create([
                'image' => $imageName,
                'product_id' => $request->product_id
            ]);
        }

        Alert::success('Sukses', 'Gambar berhasil ditambahkan');
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
