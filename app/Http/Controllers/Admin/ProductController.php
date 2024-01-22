<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $product = Product::all();
        return view('admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $kategoriProduk = ProductCategory::all();
        return view ('admin.product.create', compact('kategoriProduk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'image' => 'required|max:1024|image|mimes:png,jpg,jpeg',
            'name' => 'required|max:255',
            'category_id' => 'required',
            'price' => 'required|max:15',
            'offer_price' => 'nullable|max:15',
            'short_description' => 'required|max:255',
            'long_description' => 'required',
            'seo_title' => 'max:255',
            'seo_description' => 'max:255',
            'show_at_home' => 'boolean',
            'status' => 'required|boolean'
        ]);

        $imageName = 'product_img_' . date('YmdHis') . '.' . $request->file('thumb_image')->extension();
        $request->file('thumb_image')->move('admin/uploads/product_image/', $imageName);

        Product::create([
            'thumb_image' => $imageName,
            'name' => $request->name,
            'slug' => generateUniqueSlug('Product', $request->name),
            'category_id' => $request->category_id,
            'price' => $request->price,
            'offer_price' => $request->offer_price,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'sku' => $request->sku,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'show_at_home' => $request->show_at_home,
            'status' => $request->status,
        ]);

        Alert::success('Sukses', 'Data berhasil ditambahkan');
        return to_route('admin.product.index');
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
    public function edit(string $id) : View
    {
        $product = Product::findOrFail($id);
        $kategoriProduk = ProductCategory::all();
        return view('admin.product.edit', compact('product', 'kategoriProduk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) : RedirectResponse
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'thumb_image' => 'max:1024|image|mimes:png,jpg,jpeg',
            'name' => 'required|max:255',
            'category_id' => 'required',
            'price' => 'required|max:15',
            'offer_price' => 'nullable|max:15',
            'short_description' => 'required|max:255',
            'long_description' => 'required',
            'seo_title' => 'max:255',
            'seo_description' => 'max:255',
            'show_at_home' => 'boolean',
            'status' => 'required|boolean'
        ]);

        if ($request->hasFile('thumb_image')) {
            if (file_exists('admin/uploads/product_image/') . $product->thumb_image) {
                unlink('admin/uploads/product_image/') . $product->thumb_image;
                $imageName = 'product_img_' . date('YmdHis') . '.' . $request->file('thumb_image')->extension();
                $request->file('thumb_image')->move('admin/uploads/product_image/', $imageName);
                $product['thumb_image'] = $imageName;
            }
        }

        $product->update([
            'name' => $request->name,
            'slug' => generateUniqueSlug('Product', $request->name),
            'category_id' => $request->category_id,
            'price' => $request->price,
            'offer_price' => $request->offer_price,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'sku' => $request->sku,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'show_at_home' => $request->show_at_home,
            'status' => $request->status,
        ]);

        Alert::success('Sukses', 'Data berhasil diedit');
        return to_route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            if (file_exists('admin/uploads/product_image/') . $product->thumb_image) {
                unlink('admin/uploads/product_image/') . $product->thumb_image;
            }
            $product->delete();

            Alert::success('Sukses', 'Data telah berhasil dihapus');
            return response(['status' => 'success', 'message' => 'Data telah berhasil dihapus']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
