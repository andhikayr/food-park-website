<input type="hidden" value="{{ cartTotal() }}" id="cart_total">
<input type="hidden" value="{{ count(Cart::content()) }}" id="cart_product_count">
@if (count(Cart::content()) > 0)
    @foreach (Cart::content() as $cartProduct)
    <li>
        <div class="menu_cart_img">
            <img src="{{ asset('admin/uploads/product_image/' . $cartProduct->options->product_info['image']) }}"
                alt="menu" class="img-fluid w-100">
        </div>
        <div class="menu_cart_text">
            <a class="title"
                href="{{ route('product.show', $cartProduct->options->product_info['slug']) }}">{{ $cartProduct->name }}
            </a>
            <p class="size">jumlah : {{ $cartProduct->qty }}</p>
            <p class="size">{{ @$cartProduct->options->product_size['name'] }} {{ @$cartProduct->options->product_size['price'] ? '(Rp. '. number_format(@$cartProduct->options->product_size['price'], 0, ',', '.') . ')' : '' }}</p>
            @foreach ($cartProduct->options->product_options as $cartProductOption)
                <span class="extra">{{ $cartProductOption['name'] }} (Rp. {{ number_format($cartProductOption['price'], 0, ',', '.') }})</span>
            @endforeach
            <p class="price">Rp. {{ number_format($cartProduct->price, 0, ',', '.') }}</p>
        </div>
        <span class="del_icon" onclick="removeProductFromSidebar('{{ $cartProduct->rowId }}')"><i class="fal fa-times"></i></span>
    </li>
    @endforeach
@else
    <p class="fw-bold">Tidak ada produk apapun disini</p>
@endif
