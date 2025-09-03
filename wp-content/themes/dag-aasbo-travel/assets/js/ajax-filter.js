jQuery(document).ready(function ($) {
    let userInteracted = false;

    // Initialize slider
    $("#price-slider").slider({
        range: true,
        min: 0,
        max: 100,
        values: [0, 100],
        slide: function (event, ui) {
            $("#min_price").val(ui.values[0]);
            $("#max_price").val(ui.values[1]);
            $("#price-range-display").text(ui.values[0] + ' - ' + ui.values[1]);
        },
        stop: function () {
            userInteracted = true;
            triggerFilter();
        }
    });

    $("#min_price").val($("#price-slider").slider("values", 0));
    $("#max_price").val($("#price-slider").slider("values", 1));
    $("#price-range-display").text($("#price-slider").slider("values", 0) + ' - ' + $("#price-slider").slider("values", 1));

    function triggerFilter() {
        if (!userInteracted) return;

        let colors = [];
        $('input[name="color[]"]:checked').each(function () {
            colors.push($(this).val());
        });

        let sizes = [];
        $('input[name="size[]"]:checked').each(function () {
            sizes.push($(this).val());
        });

        let min_price = $('#min_price').val();
        let max_price = $('#max_price').val();
        let stock_status = $('input[name="stock_status"]:checked').val();

        $.ajax({
            url: my_ajax_object.ajax_url,
            method: 'POST',
            data: {
                action: 'filter_products',
                colors: JSON.stringify(colors),
                sizes: JSON.stringify(sizes),
                min_price: min_price,
                max_price: max_price,
                stock_status: stock_status
            },
            beforeSend: function () {
                $('#ajax-products').html('<p>Loading products...</p>');
            },
            success: function (response) {
                $('#ajax-products').html(response);

                // ✅ Re-init wishlist icons
                if (typeof yith_wcwl_init !== 'undefined') {
                    yith_wcwl_init();
                }
            },
            error: function () {
                $('#ajax-products').html('<p>Something went wrong.</p>');
            }
        });
    }

    $('input[name="color[]"], input[name="size[]"], input[name="stock_status"]').on('change', function () {
        userInteracted = true;
        triggerFilter();
    });
});
