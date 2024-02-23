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
                                            <a class="clear_all" href="#">bersihkan semua keranjang</a>
                                        </th>
                                    </tr>
                                    @foreach (Cart::content() as $product)
                                        <tr>
                                            <td class="fp__pro_img"><img src="{{ asset('admin/uploads/product_image/' . $product->options->product_info['image']) }}" alt="product" class="img-fluid w-100">
                                            </td>

                                            <td class="fp__pro_name">
                                                <a href="{{ route('product.show', $product->options->product_info['slug']) }}">{{ $product->name }}</a>
                                                <span>{{ $product->options->product_size['name'] }} (Rp. {{ number_format($product->options->product_size['price'], 0, ',', '.') }})</span>
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
                                                    <input type="text" value="{{ $product->qty }}" class="quantity" readonly>
                                                    <button class="btn btn-success increment"><i class="fal fa-plus"></i></button>
                                                </div>
                                            </td>

                                            <td class="fp__pro_tk">
                                                <h6>$180,00</h6>
                                            </td>

                                            <td class="fp__pro_icon">
                                                <a href="#"><i class="far fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__cart_list_footer_button">
                        <h6>total cart</h6>
                        <p>subtotal: <span>$124.00</span></p>
                        <p>delivery: <span>$00.00</span></p>
                        <p>discount: <span>$10.00</span></p>
                        <p class="total"><span>total:</span> <span>$134.00</span></p>
                        <form>
                            <input type="text" placeholder="Coupon Code">
                            <button type="submit">apply</button>
                        </form>
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
            // Tambah dan kurangi jumlah produk yang dibeli
            $('.increment').on('click', function () {
                let inputField = $(this).siblings(".quantity");
                let currentValue = parseInt(inputField.val());
                inputField.val(currentValue + 1);
            });

            $('.decrement').on('click', function () {
                let inputField = $(this).siblings(".quantity");
                let currentValue = parseInt(inputField.val());
                if (inputField.val() > 1) {
                    inputField.val(currentValue - 1);
                }
            });
        });
    </script>
@endpush
