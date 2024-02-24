<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Cart;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function index() : View
    {
        return view('frontend.pages.cart-view');
    }

    public function addToCart(Request $request)
    {
        try {
            $product = Product::with(['productSizes', 'productOptions'])->findOrFail($request->product_id);
            $productSize = $product->productSizes->where('id', $request->product_size)->first();
            $productOptions = $product->productOptions->whereIn('id', $request->product_option);

            $options = [
                'product_size' => [],
                'product_options' => [],
                'product_info' => [
                    'image' => $product->thumb_image,
                    'slug' => $product->slug
                ]
            ];

            if ($productSize !== null) {
                $options['product_size'] = [
                    'id' => $productSize?->id,
                    'name' => $productSize?->name,
                    'price' => $productSize?->price
                ];
            }

            foreach ($productOptions as $option) {
                $options['product_options'][] = [
                    'id' => $option->id,
                    'name' => $option->name,
                    'price' => $option->price
                ];
            }

            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => $request->quantity,
                'price' => $product->offer_price > 0 ? $product->offer_price : $product->price,
                'weight' => 0,
                'options' => $options
            ]);

            return response(['status' => 'success', 'message' => 'Produk berhasil ditambahkan ke keranjang'], 200);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'Ada sesuatu yang salah'], 500);
        }
    }

    public function getCartProducts()
    {
        return view('frontend.layouts.ajax.sidebar-cart-item')->render();
    }

    public function cartProductRemove($rowId)
    {
        try {
            Cart::remove($rowId);

            return response(['status' => 'success', 'message' => 'Produk berhasil dihapus dari keranjang'], 200);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'Ada sesuatu yang salah'], 500);
        }
    }

    public function cartQtyUpdate(Request $request) : Response
    {
        try {
            Cart::update($request->rowId, $request->qty);

            return response(['product_total' => productTotal($request->rowId)], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['status' => 'error', 'message' => 'Ada sesuatu yang salah'], 500);
        }
    }

    public function cartDestroy()
    {
        Cart::destroy();

        Alert::success('Sukses', 'Keranjang anda telah berhasil dihapus');
        return back();
    }
}
