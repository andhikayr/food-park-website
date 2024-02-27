<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Cart;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function index() : View
    {
        return view('frontend.pages.cart-view');
    }

    public function addToCart(Request $request)
    {
        $product = Product::with(['productSizes', 'productOptions'])->findOrFail($request->product_id);
        if ($product->quantity < $request->quantity) {
            throw ValidationException::withMessages(['Jumlah barang tidak boleh kurang dari stok']);
        }
        try {
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

            return response(['status' => 'success', 'message' => 'Produk berhasil dihapus dari keranjang', 'cart_total' => cartTotal(), 'grand_cart_total' => grandCartTotal()], 200);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'Ada sesuatu yang salah'], 500);
        }
    }

    public function cartQtyUpdate(Request $request) : Response
    {
        $cartItem = Cart::get($request->rowId);
        $product = Product::findOrFail($cartItem->id);
        if ($product->quantity < $request->qty) {
            return response(['status' => 'error', 'message' => 'Jumlah barang tidak boleh kurang dari stok', 'qty' => $cartItem->qty]);
        }
        try {
            $cart = Cart::update($request->rowId, $request->qty);

            return response(['status' => 'success', 'product_total' => productTotal($request->rowId), 'qty' => $cart->qty, 'cart_total' => cartTotal(), 'grand_cart_total' => grandCartTotal()], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['status' => 'error', 'message' => 'Ada sesuatu yang salah'], 500);
        }
    }

    public function cartDestroy()
    {
        if (count(Cart::content()) <= 0) {
            Alert::error('Eror', 'Tidak ada produk apapun di keranjang anda');
        } else {
            Cart::destroy();
            session()->forget('coupon');
            Alert::success('Sukses', 'Keranjang anda telah berhasil dihapus');
        }
        return back();
    }
}
