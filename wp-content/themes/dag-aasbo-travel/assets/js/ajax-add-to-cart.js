jQuery(function ($) {
  $('.ajax-add-to-cart-form').on('submit', function (e) {
    e.preventDefault();

    const form = $(this);
    const button = form.find('button[name="add-to-cart"]');
    const product_id = button.val();
    const quantity = form.find('input.qty-input').val();

    $.ajax({
      type: 'POST',
      url: ajax_object.ajax_url,
      data: {
        action: 'ajax_add_to_cart',
        product_id: product_id,
        quantity: quantity,
        nonce: ajax_object.nonce
      },
      beforeSend: function () {
        button.prop('disabled', true).text('Adding...');
      },
      success: function (response) {
        if (response.fragments) {
          // ✅ WooCommerce returns updated fragments — apply them
          $.each(response.fragments, function (key, value) {
            $(key).replaceWith(value);
          });

          button.text('Added ✔');
        } else {
          alert(response.data?.message || 'Could not add to cart.');
          button.text('Add to cart');
        }
      },
      complete: function () {
        button.prop('disabled', false);
      }
    });
  });
});
