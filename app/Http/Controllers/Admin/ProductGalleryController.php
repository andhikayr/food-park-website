<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use RealRashid\SweetAlert\Facades\Alert;

class ProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($productId): View
    {
        $images = ProductGallery::where('product_id', $productId)->get();
        $product = Product::findOrFail($productId);
        return view('admin.product.gallery.index', compact('product', 'images'));
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

        Alert::success('Sukses', 'Gambar produk berhasil ditambahkan');
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
    public function destroy(string $id) : Response
    {
        try {
            $image = ProductGallery::findOrFail($id);
            if (file_exists('admin/uploads/product_image/' . $image->image)) {
                unlink('admin/uploads/product_image/' . $image->image);
            }
            $image->delete();

            Alert::success('Sukses', 'Gambar produk telah berhasil dihapus');
            return response(['status' => 'success', 'message' => 'Gambar produk telah berhasil dihapus']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
