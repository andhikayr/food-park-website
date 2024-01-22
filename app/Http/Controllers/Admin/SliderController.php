<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'image' => 'required|max:1024|image|mimes:png,jpg,jpeg',
            'product_offer' => 'between:1,100',
            'title' => 'required|max:255',
            'sub_title' => 'required|max:255',
            'short_description' => 'required|max:255',
            'button_link' => 'max:255',
            'status' => 'boolean'
        ]);

        $imageName = 'slider_img_' . date('YmdHis') . '.' . $request->file('image')->extension();
        $request->file('image')->move('admin/uploads/slider_image/', $imageName);

        Slider::create([
            'image' => $imageName,
            'product_offer' => $request->product_offer,
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'short_description' => $request->short_description,
            'button_link' => $request->button_link,
            'status' => $request->status
        ]);

        Alert::success('Sukses', 'Data telah berhasil ditambahkan');
        return to_route('admin.slider.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) : RedirectResponse
    {
        $request->validate([
            'image' => 'max:1024|image|mimes:png,jpg,jpeg',
            'product_offer' => 'between:1,100',
            'title' => 'required|max:255',
            'sub_title' => 'required|max:255',
            'short_description' => 'required|max:255',
            'button_link' => 'max:255',
            'status' => 'boolean'
        ]);

        $slider = Slider::findOrFail($id);

        if ($request->hasFile('image')) {
            if (file_exists('admin/uploads/slider_image/') . $slider->image) {
                unlink('admin/uploads/slider_image/') . $slider->image;
                $imageName = 'slider_img_' . date('YmdHis') . '.' . $request->file('image')->extension();
                $request->file('image')->move('admin/uploads/slider_image/', $imageName);
                $slider['image'] = $imageName;
            }
        }

        $slider->update([
            'product_offer' => $request->product_offer,
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'short_description' => $request->short_description,
            'button_link' => $request->button_link,
            'status' => $request->status
        ]);

        Alert::success('Sukses', 'Data telah berhasil diperbarui');
        return to_route('admin.slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $slider = Slider::findOrFail($id);
            if (file_exists('admin/uploads/slider_image/') . $slider->image) {
                unlink('admin/uploads/slider_image/') . $slider->image;
            }
            $slider->delete();

            Alert::success('Sukses', 'Data telah berhasil dihapus');
            return response(['status' => 'success', 'message' => 'Data telah berhasil dihapus']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
