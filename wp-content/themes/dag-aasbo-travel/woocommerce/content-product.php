<?php
defined('ABSPATH') || exit;
global $product;

if (!is_a($product, WC_Product::class) || !$product->is_visible()) {
  return;
}
?>

<li <?php wc_product_class('col-md-3', $product); ?>>
  <div class="product-card p-3 border rounded-4 h-100 d-flex flex-column text-center shadow-sm hover-shadow">

    <!-- Product Image -->
    <a href="<?php the_permalink(); ?>" class="product-image mb-2">
      <?php woocommerce_show_product_loop_sale_flash(); ?>
      <?php woocommerce_template_loop_product_thumbnail(); ?>
    </a>

    <!-- Wishlist Icon (Your Original Position, Below Image to Right) -->
    <div class="wishlist-button mb-2 text-end">
      <?php echo do_shortcode('[yith_wcwl_add_to_wishlist label="" product_added_text="" already_in_wishlist_text="" icon="fa-heart" link_classes="wishlist-visible-icon"]'); ?>
    </div>

    <!-- Product Title -->
    <div class="product-title mb-2">
      <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark fw-semibold">
        <?php woocommerce_template_loop_product_title(); ?>
      </a>
    </div>

    <!-- Product Price -->
    <div class="product-price mb-2">
      <?php woocommerce_template_loop_price(); ?>
    </div>

    <!-- Rating -->
    <div class="product-rating mb-2">
      <?php woocommerce_template_loop_rating(); ?>
    </div>

    <!-- Add to Cart -->
    <div class="mt-auto">
      <form class="cart ajax-add-to-cart-form d-flex align-items-center justify-content-between" action="<?php echo esc_url($product->add_to_cart_url()); ?>" method="post" enctype="multipart/form-data">
        <div class="quantity quantity-picker d-flex align-items-center me-2">
          <button type="button" class="minus">−</button>
          <?php
            $max_qty = $product->get_max_purchase_quantity();
            $max_attr = ($max_qty > 0) ? 'max="' . esc_attr($max_qty) . '"' : '';
          ?>
          <input
            type="number"
            class="qty-input"
            name="quantity"
            value="1"
            min="1"
            step="1"
            <?php echo $max_attr; ?>
          />
          <button type="button" class="plus">+</button>
        </div>
        <button
          type="submit"
          name="add-to-cart"
          value="<?php echo esc_attr($product->get_id()); ?>"
          class="button add_to_cart_button ajax-add-to-cart"
          data-product_id="<?php echo esc_attr($product->get_id()); ?>"
          data-quantity="1"
          style="font-size: 12.5px; margin-top: -1px;">
          Add to cart
        </button>
      </form>
    </div>

  </div>
</li>
