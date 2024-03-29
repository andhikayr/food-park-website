@extends('frontend.layouts.master')

@section('title')
    Keranjang Produk
@endsection

@section('content')
    @include('frontend.components.breadcrumb')
    <!--============================
        CART VIEW START
    ==============================-->
    <section class="fp__cart_view mt_125 xs_mt_95 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__cart_list">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr>
                                        <th class="fp__pro_img">
                                            Gambar
                                        </th>

                                        <th class="fp__pro_name">
                                            detil pesanan
                                        </th>

                                        <th class="fp__pro_status">
                                            harga
                                        </th>

                                        <th class="fp__pro_select">
                                            jumlah
                                        </th>

                                        <th class="fp__pro_tk">
                                            total
                                        </th>

                                        <th class="fp__pro_icon">
                                            <a class="clear_all" href="{{ route('cart.destroy') }}">bersihkan keranjang</a>
                                        </th>
                                    </tr>
                                    @if (count(Cart::content()) > 0)
                                        @foreach (Cart::content() as $product)
                                        <tr>
                                            <td class="fp__pro_img"><img src="{{ asset('admin/uploads/product_image/' . $product->options->product_info['image']) }}" alt="product" class="img-fluid w-100">
                                            </td>

                                            <td class="fp__pro_name">
                                                <a href="{{ route('product.show', $product->options->product_info['slug']) }}">{{ $product->name }}</a>
                                                <span>{{ @$product->options->product_size['name'] }} {{ @$product->options->product_size['price'] ? '(Rp. ' . number_format($product->options->product_size['price'], 0, ',', '.') . ')' : '' }}</span>
                                                @foreach ($product->options->product_options as $option)
                                                    <p>{{ $option['name'] }} (Rp. {{ number_format($option['price'], 0, ',', '.') }})</p>
                                                @endforeach
                                            </td>

                                            <td class="fp__pro_status">
                                                <h6>Rp. {{ number_format($product->price, 0, ',', '.') }}</h6>
                                            </td>

                                            <td class="fp__pro_select">
                                                <div class="quentity_btn">
                                                    <button class="btn btn-danger decrement"><i class="fal fa-minus"></i></button>
                                                    <input type="text" data-id="{{ $product->rowId }}" value="{{ $product->qty }}" class="quantity" readonly>
                                                    <button class="btn btn-success increment"><i class="fal fa-plus"></i></button>
                                                </div>
                                            </td>

                                            <td class="fp__pro_tk">
                                                <h6 class="product_cart_total">Rp. {{ number_format(productTotal($product->rowId), 0, ',', '.') }}</h6>
                                            </td>

                                            <td class="fp__pro_icon">
                                                <a href="#" class="remove_cart_product" data-id="{{ $product->rowId }}"><i class="far fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @else
                                        <tr>
                                            <td class="border-0" style="background-color: white">Tidak ada produk apapun disini</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__cart_list_footer_button">
                        <h6>total keranjang</h6>
                        <p>subtotal: <span id="subtotal">Rp. {{ number_format(cartTotal(), 0, ',', '.') }}</span></p>
                        <p>pengiriman: <span>$00.00</span></p>
                        <p>diskon: <span id="discount">Rp.
                            @if (isset(session()->get('coupon')['discount']))
                                {{ number_format(session()->get('coupon')['discount'], 0, ',', '.') }}
                            @else
                                0
                            @endif
                        </span></p>
                        <p class="total"><span>total:</span> <span id="final_total"> Rp.
                            @if (isset(session()->get('coupon')['discount']))
                                {{ number_format(cartTotal() - session()->get('coupon')['discount'], 0, ',', '.') }}
                            @else
                            {{ number_format(cartTotal(), 0, ',', '.') }}
                            @endif
                        </span></p>
                        <form id="coupon_form">
                            <input type="text" id="coupon_code" name="code" placeholder="Kode Kupon">
                            <button type="submit">terapkan kupon</button>
                        </form>
                        <div class="coupon_card">
                            @if (session()->has('coupon'))
                                <div class="card mt-2">
                                    <div class="m-3" style="border-radius: 10px">
                                        <span><b class="v_coupon_code">Kupon yang digunakan : {{ session()->get('coupon')['code'] }}</b></span>
                                        <span>
                                            <button id="destroy_coupon"><i class="far fa-times"></i></button>
                                        </span>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <a class="common_btn" href=" #">checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        CART VIEW END
    ==============================-->
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            var cartTotal = parseInt("{{ cartTotal() }}");

            // Tambah dan kurangi jumlah produk yang dibeli
            $('.increment').on('click', function () {
                let inputField = $(this).siblings(".quantity");
                let currentValue = parseInt(inputField.val());
                let rowId = inputField.data("id");
                inputField.val(currentValue + 1);

                cartQtyUpdate(rowId, inputField.val(), function (response) {
                    if (response.status === 'success') {
                        inputField.val(response.qty);
                        let productTotal = response.product_total;
                        totalPrice = formatRupiah(productTotal.toString());
                        inputField.closest("tr").find(".product_cart_total").text("Rp. " + totalPrice);

                        cartTotal = response.cart_total;
                        grandCartTotal = response.grand_cart_total;
                        $('#subtotal').text("Rp. " + formatRupiah(cartTotal.toString()));
                        $('#final_total').text("Rp. " + formatRupiah(grandCartTotal.toString()));
                    } else if (response.status === 'error') {
                        inputField.val(response.qty);
                        toastr.error(response.message);
                    }
                });
            });

            $('.decrement').on('click', function () {
                let inputField = $(this).siblings(".quantity");
                let currentValue = parseInt(inputField.val());
                let rowId = inputField.data("id");

                if (inputField.val() > 1) {
                    inputField.val(currentValue - 1);
                    cartQtyUpdate(rowId, inputField.val(), function (response) {
                        if (response.status === 'success') {
                            inputField.val(response.qty);
                            let productTotal = response.product_total;
                            totalPrice = formatRupiah(productTotal.toString());
                            inputField.closest("tr").find(".product_cart_total").text("Rp. " + totalPrice);

                            cartTotal = response.cart_total;
                            grandCartTotal = response.grand_cart_total;
                            $('#subtotal').text("Rp. " + formatRupiah(cartTotal.toString()));
                            $('#final_total').text("Rp. " + formatRupiah(grandCartTotal.toString()));
                        } else if (response.status === 'error') {
                            inputField.val(response.qty);
                            toastr.error(response.message);
                        }
                    });
                }
            });

            function cartQtyUpdate(rowId, qty, callback) {
                $.ajax({
                    method: 'POST',
                    url: '{{ route("cart.quantity-update") }}',
                    data: {
                        'rowId': rowId,
                        'qty': qty
                    },
                    beforeSend: function () {
                        showLoader();
                    },
                    success: function (response) {
                        if (callback && typeof callback === 'function') {
                            callback(response);
                        }
                    },
                    error: function (xhr, status, error) {
                        let errorMessage = xhr.responseJSON.message;
                        hideLoader();
                        toastr.error(errorMessage);
                    },
                    complete: function () {
                        hideLoader();
                    }
                });
            }

            $('.remove_cart_product').on('click', function (e) {
                e.preventDefault();
                let rowId = $(this).data('id');
                removeCartProduct(rowId);
                $(this).closest('tr').remove();
            });

            function removeCartProduct(rowId) {
                $.ajax({
                    method: 'GET',
                    url: '{{ route("cart-product-remove", ":rowId") }}' . replace(":rowId", rowId),
                    beforeSend: function () {
                        showLoader();
                    },
                    success: function (response) {
                        updateSidebarCart(function () {
                            cartTotal = response.cart_total;
                            grandCartTotal = response.grand_cart_total;
                            $('#subtotal').text("Rp. " + formatRupiah(cartTotal.toString()));
                            $('#final_total').text("Rp. " + formatRupiah(grandCartTotal.toString()));
                            toastr.success(response.message);
                            hideLoader();
                        });
                    },
                    error: function (xhr, status, error) {
                        let errorMessage = xhr.responseJSON.message;
                        hideLoader();
                        toastr.error(errorMessage);
                    }
                });
            }

            $('#coupon_form').on('submit', function (e) {
                e.preventDefault();
                let subtotal = cartTotal;
                let code = $('#coupon_code').val();
                couponApply(code, subtotal);
            });

            function couponApply(code, subtotal) {
                $.ajax({
                    method: 'POST',
                    url: '{{ route("apply-coupon") }}',
                    data: {
                        code: code,
                        subtotal: subtotal
                    },
                    beforeSend: function () {
                        showLoader();
                    },
                    success: function (response) {
                        $('#coupon_code').val("");
                        $('#discount').text("Rp. " + formatRupiah(response.discount.toString()));
                        $('#final_total').text("Rp. " + formatRupiah(response.finalTotal.toString()));
                        couponCartHtml = `<div class="card mt-2">
                            <div class="m-3" style="border-radius: 10px">
                                <span><b class="v_coupon_code">Kupon yang digunakan : ${response.coupon_code}</b></span>
                                <span>
                                    <button id="destroy_coupon"><i class="far fa-times"></i></button>
                                </span>
                            </div>
                        </div>`;
                        $('.coupon_card').html(couponCartHtml);
                        toastr.success(response.message);
                    },
                    error: function (xhr, status, error) {
                        let errorMessage = xhr.responseJSON.message;
                        hideLoader();
                        toastr.error(errorMessage);
                    },
                    complete: function () {
                        hideLoader();
                    }
                });
            }

            $(document).on('click', "#destroy_coupon", function () {
                destroyCoupon();
            });

            function destroyCoupon() {
                $.ajax({
                    method: 'GET',
                    url: '{{ route("destroy-coupon") }}',
                    beforeSend: function () {
                        showLoader();
                    },
                    success: function (response) {
                        $('.coupon_card').html("");
                        $('#discount').text("Rp. 0");
                        grandCartTotal = response.grand_cart_total;
                        $('#final_total').text("Rp. " + formatRupiah(grandCartTotal.toString()));
                        toastr.success(response.message);
                    },
                    error: function (xhr, status, error) {
                        let errorMessage = xhr.responseJSON.message;
                        toastr.error(errorMessage);
                    },
                    complete: function () {
                        hideLoader();
                    }
                });
            }
        });
    </script>
@endpush
