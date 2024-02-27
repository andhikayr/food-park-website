<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\SectionTitle;
use App\Models\Slider;
use App\Models\WhyChooseUs;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class FrontendController extends Controller
{
    public function index(): View
    {
        $sliders = Slider::where('status', 1)->get();
        $sectionTitles = $this->getSectionTitles();
        $WhyChooseUs = WhyChooseUs::where('status', 1)->get();
        $categories = ProductCategory::where(['show_at_home' => 1, 'status' => 1])->get();
        return view('index', compact('sliders', 'sectionTitles', 'WhyChooseUs', 'categories'));
    }

    public function getSectionTitles(): Collection
    {
        $keys = [
            'why_choose_top_title',
            'why_choose_main_title',
            'why_choose_sub_title'
        ];

        return SectionTitle::whereIn('key', $keys)->pluck('value', 'key');
    }

    public function showProduct($slug) : View {
        $product = Product::with(['productImages', 'productSizes', 'productOptions'])->where(['slug' => $slug, 'status' => 1])->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->latest()->take(8)->get();
        return view('frontend.pages.product-view', compact('product', 'relatedProducts'));
    }

    public function loadProductModal($productId) {
        $product = Product::with(['productSizes', 'productOptions'])->findOrFail($productId);
        return view('frontend.layouts.ajax.product-popup-modal', compact('product'))->render();
    }

    public function applyCoupon(Request $request) : Response {
        $subtotal = $request->subtotal;
        $code = $request->code;
        $coupon = Coupon::where('code', $code)->first();

        if (!$coupon) {
            return response(['message' => 'Kode kupon tidak ditemukan'], 422);
        } else if ($coupon->quantity <= 0) {
            return response(['message' => 'Kode kupon sudah habis'], 422);
        } else if ($coupon->expire_date < now()) {
            return response(['message' => 'Kode kupon sudah kadaluarsa'], 422);
        }

        if ($coupon->discount_type === 'percent') {
            $discount = number_format($subtotal * ($coupon->discount / 100), 2);
        } else if ($coupon->discount_type === 'amount') {
            $discount = number_format($coupon->discount, 2);
        }

        $finalTotal = $subtotal - $discount;
        return response(['message' => 'Kupon berhasil diterapkan', 'discount' => $discount, 'finalTotal' => $finalTotal]);
    }
}
