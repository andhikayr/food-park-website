<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
<form action="" id="modal_add_to_cart_form">
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <div class="fp__cart_popup_img">
        <img src="{{ asset('admin/uploads/product_image/' . $product->thumb_image) }}" alt="{{ $product->name }}"
            class="img-fluid w-100">
    </div>
    <div class="fp__cart_popup_text">
        <a href="{{ route('product.show', $product->slug) }}" class="title">{{ $product->name }}</a>
        <p class="rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <i class="far fa-star"></i>
            <span>(201)</span>
        </p>
        <h4 class="price">
            @if ($product->offer_price > 0)
                <input type="hidden" name="base_price" value="{{ $product->offer_price }}">
                Rp. {{ number_format($product->offer_price, 0, ',', '.') }}
                <del>Rp. {{ number_format($product->price, 0, ',', '.') }}</del>
            @else
                <input type="hidden" name="base_price" value="{{ $product->price }}">
                Rp. {{ number_format($product->price, 0, ',', '.') }}
            @endif
        </h4>

        @if ($product->productSizes()->exists())
            <div class="details_size">
                <h5>pilih ukuran</h5>
                @foreach ($product->productSizes as $productSize)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="{{ $productSize->id }}"
                            data-price="{{ $productSize->price }}" name="product_size"
                            id="size-{{ $productSize->id }}" required>
                        <label class="form-check-label" for="size-{{ $productSize->id }}">
                            {{ $productSize->name }} <span>+ Rp.
                                {{ number_format($productSize->price, 0, ',', '.') }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        @endif

        @if ($product->productOptions()->exists())
            <div class="details_extra_item">
                <h5>pilih opsi <span>(opsional)</span></h5>
                @foreach ($product->productOptions as $productOption)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="product_option[]"
                            data-price="{{ $productOption->price }}" value="{{ $productOption->id }}"
                            id="option-{{ $productOption->id }}">
                        <label class="form-check-label" for="option-{{ $productOption->id }}">
                            {{ $productOption->name }} <span>+ Rp.
                                {{ number_format($productOption->price, 0, ',', '.') }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="details_quentity">
            <h5>pilih jumlah</h5>
            <div class="quentity_btn_area d-flex flex-wrapa align-items-center">
                <div class="quentity_btn">
                    <button class="btn btn-danger decrement"><i class="fal fa-minus"></i></button>
                    <input type="text" id="quantity" name="quantity" placeholder="1" value="1" readonly>
                    <button class="btn btn-success increment"><i class="fal fa-plus"></i></button>
                </div>
                @if ($product->offer_price > 0)
                    <h3 id="total_price">Rp. {{ number_format($product->offer_price, 0, ',', '.') }}</span></h3>
                @else
                    <h3 id="total_price">Rp. {{ number_format($product->price, 0, ',', '.') }}</span></h3>
                @endif
            </div>
        </div>
        <ul class="details_button_area d-flex flex-wrap">
            <li><button type="submit" class="common_btn modal_cart_button">tambah ke keranjang</button></li>
        </ul>
    </div>
</form>

<script>
    // Update harga total
    $(document).ready(function() {
        $('input[name="product_size"]').on('change', function() {
            updateTotalPrice();
        });

        $('input[name="product_option[]"]').on('change', function() {
            updateTotalPrice();
        });

        $('.increment').on('click', function (e) {
            e.preventDefault();
            let quantity = $('#quantity');
            let currentQuantity = parseInt(quantity.val());
            quantity.val(currentQuantity + 1);
            updateTotalPrice();
        });

        $('.decrement').on('click', function (e) {
            e.preventDefault();
            let quantity = $('#quantity');
            let currentQuantity = parseInt(quantity.val());
            if (currentQuantity > 1) {
                quantity.val(currentQuantity - 1);
                updateTotalPrice();
            }
        });

        function updateTotalPrice() {
            let basePrice = parseInt($('input[name="base_price"]').val());
            let selectedSizePrice = 0;
            let selectedOptionsPrice = 0;
            let quantity = parseInt($('#quantity').val());

            // Hitung harga dari radio button product_size
            let selectedSize = $('input[name="product_size"]:checked');
            if (selectedSize.length > 0) {
                selectedSizePrice = parseInt(selectedSize.data("price"));
            }

            // Hitung harga dari checkbox product_size
            let selectedOptions = $('input[name="product_option[]"]:checked');
            $(selectedOptions).each(function(item) {
                selectedOptionsPrice += parseInt($(this).data("price"));
            });

            // Hitung harga total
            let totalPrice = (basePrice + selectedSizePrice + selectedOptionsPrice) * quantity;
            totalPrice = formatRupiah(totalPrice.toString());
            $('#total_price').text("Rp. " + totalPrice);
        }

        // format rupiah
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        // function tambah ke keranjang
        $("#modal_add_to_cart_form").on('submit', function (e) {
            e.preventDefault();

            // validasi data
            let selectedSize = $("input[name='product_size']");
            if (selectedSize.length > 0) {
                if ($("input[name='product_size']:checked").val() === undefined) {
                    toastr.error('Pilih ukuran produk terlebih dahulu');
                    return;
                }
            }

            let formData = $(this).serialize();
            $.ajax({
                method: 'POST',
                url: '{{ route("add-to-cart") }}',
                data: formData,
                beforeSend: function () {
                    $('.modal_cart_button').attr('disabled', true);
                    $('.modal_cart_button').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Tunggu sebentar...');
                },
                success: function (response) {
                    updateSidebarCart(function () {
                        toastr.success(response.message);
                    });
                },
                error: function (xhr, status, error) {
                    let errorMessage = xhr.responseJSON.message;
                    toastr.error(errorMessage);
                },
                complete: function () {
                    $('.modal_cart_button').html('Tambah ke keranjang');
                    $('.modal_cart_button').attr('disabled', false);
                }
            });
        });
    });
</script>
