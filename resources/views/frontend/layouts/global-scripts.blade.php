<script>
    /** Load product modal **/
    function loadProductModal(productId) {
        $.ajax({
            method: 'GET',
            url: '{{ route('load-product-modal', ':productId') }}'.replace(':productId', productId),
            beforeSend: function() {
                $('.overlay-container').removeClass('d-none');
                $('.overlay').addClass('active');
            },
            success: function(response) {
                $(".load_product_modal_body").html(response);
                $('#cartModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error(error);
            },
            complete: function() {
                $('.overlay').removeClass('active');
                $('.overlay-container').addClass('d-none');
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
    function updateSidebarCart() {
        $.ajax({
            method: 'GET',
            url: '{{ route('get-cart-products') }}',
            beforeSend: function() {

            },
            success: function(response) {
                $('.cart_contents').html(response);
                let cartTotal = $('#cart_total').val();
                totalPrice = formatRupiah(cartTotal.toString());
                $('.cart_subtotal').text("Rp. " + totalPrice);
            },
            error: function(xhr, status, error) {
                console.error(error);
            },
            complete: function() {

            }
        });
    }
</script>
