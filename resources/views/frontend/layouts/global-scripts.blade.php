<script>
    /** Tampilkan loader **/
    function showLoader() {
        $('.overlay-container').removeClass('d-none');
        $('.overlay').addClass('active');
    }

    /** Sembunyikan loader **/
    function hideLoader() {
        $('.overlay').removeClass('active');
        $('.overlay-container').addClass('d-none');
    }

    /** Load product modal **/
    function loadProductModal(productId) {
        $.ajax({
            method: 'GET',
            url: '{{ route('load-product-modal', ':productId') }}'.replace(':productId', productId),
            beforeSend: function() {
                showLoader();
            },
            success: function(response) {
                $(".load_product_modal_body").html(response);
                $('#cartModal').modal('show');
            },
            error: function(xhr, status, error) {
                let errorMessage = xhr.responseJSON.message;
                toastr.error(errorMessage);
            },
            complete: function() {
                hideLoader();
            }
        });
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

    /** Update keranjang di sidebar **/
    function updateSidebarCart(callback = null) {
        $.ajax({
            method: 'GET',
            url: '{{ route('get-cart-products') }}',
            success: function(response) {
                $('.cart_contents').html(response);
                let cartTotal = $('#cart_total').val();
                let cartCount = $('#cart_product_count').val();
                totalPrice = formatRupiah(cartTotal.toString());
                $('.cart_subtotal').text("Rp. " + totalPrice);
                $('.cart_count').text(cartCount);

                if (callback && typeof callback === 'function') {
                    callback();
                }
            },
            error: function(xhr, status, error) {
                let errorMessage = xhr.responseJSON.message;
                toastr.error(errorMessage);
            }
        });
    }

    /** Hapus produk dari keranjang di sidebar **/
    function removeProductFromSidebar($rowId) {
        $.ajax({
            method: 'GET',
            url: '{{ route("cart-product-remove", ":rowId") }}'.replace(":rowId", $rowId),
            beforeSend: function () {
                showLoader();
            },
            success: function (response) {
                if (response.status === 'success') {
                    updateSidebarCart(function () {
                        toastr.success(response.message);
                        hideLoader();
                    });
                }
            },
            error: function(xhr, status, error) {
                let errorMessage = xhr.responseJSON.message;
                toastr.error(errorMessage);
            }
        });
    }
</script>
