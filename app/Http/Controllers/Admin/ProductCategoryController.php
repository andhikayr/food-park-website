<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use RealRashid\SweetAlert\Facades\Alert;
use Str;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $productCategory = ProductCategory::latest()->get();
        return view('admin.product.category.index', compact('productCategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('admin.product.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCategoryRequest $request) : RedirectResponse
    {
        ProductCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status,
            'show_at_home' => $request->show_at_home
        ]);

        Alert::success('Sukses', 'Data berhasil ditambahkan');
        return to_route('admin.product-category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) : View
    {
        $productCategory = ProductCategory::findOrFail($id);
        return view('admin.product.category.edit', compact('productCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductCategoryRequest $request, $id) : RedirectResponse
    {
        $productCategory = ProductCategory::findOrFail($id);

        $productCategory->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status,
            'show_at_home' => $request->show_at_home
        ]);

        Alert::success('Sukses', 'Data berhasil diubah');
        return to_route('admin.product-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $slider = ProductCategory::findOrFail($id);
            $slider->delete();

            Alert::success('Sukses', 'Data telah berhasil dihapus');
            return response(['status' => 'success', 'message' => 'Data telah berhasil dihapus']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
