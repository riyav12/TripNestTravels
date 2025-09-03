jQuery(function ($) {
    $('.woocommerce').on('change', 'input.qty', function () {
        var $form = $('form.woocommerce-cart-form');

        // Trigger cart update
        $form.find('button[name="update_cart"]').prop('disabled', false).trigger('click');

        // After cart updates
        $(document.body).one('updated_wc_div', function () {
            // Refresh cart fragments for header count
            $.ajax({
                url: wc_cart_fragments_params.wc_ajax_url
                    .replace('%%endpoint%%', 'get_refreshed_fragments'),
                type: 'POST',
                success: function (data) {
                    if (data && data.fragments) {
                        $.each(data.fragments, function (key, value) {
                            $(key).replaceWith(value);
                        });
                    }
                }
            });
        });
    });
});

jQuery(function($) {
    // Listen for WooCommerce "added to cart" event on any page
    $('body').on('added_to_cart', function() {
        // Refresh cart fragments to update header cart count
        $.ajax({
            url: wc_cart_fragments_params.wc_ajax_url
                .replace('%%endpoint%%', 'get_refreshed_fragments'),
            type: 'POST',
            success: function (data) {
                if (data && data.fragments) {
                    $.each(data.fragments, function (key, value) {
                        $(key).replaceWith(value);
                    });
                }
            }
        });
    });
});
