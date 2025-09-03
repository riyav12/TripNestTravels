<?php
defined( 'ABSPATH' ) || exit;

global $product;

do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'container py-5 custom-product-page', $product ); ?>>

  <div class="row g-5 align-items-start">
    
    <!-- Product Image -->
    <div class="col-md-6">
      <?php
      /**
       * woocommerce_before_single_product_summary hook.
       *
       * @hooked woocommerce_show_product_sale_flash - 10
       * @hooked woocommerce_show_product_images - 20
       */
      do_action( 'woocommerce_before_single_product_summary' );
      ?>
    </div>

    <!-- Product Details -->
    <div class="col-md-6">
      <div class="summary entry-summary">
        <?php
        /**
         * woocommerce_single_product_summary hook.
         *
         * @hooked woocommerce_template_single_title - 5
         * @hooked woocommerce_template_single_rating - 10
         * @hooked woocommerce_template_single_price - 10
         * @hooked woocommerce_template_single_excerpt - 20
         * @hooked woocommerce_template_single_add_to_cart - 30
         * @hooked woocommerce_template_single_meta - 40
         * @hooked woocommerce_template_single_sharing - 50
         * @hooked WC_Structured_Data::generate_product_data() - 60
         */
        do_action( 'woocommerce_single_product_summary' );
        ?>
      </div>
    </div>

  </div>

  <!-- Tabs, Upsells, Related -->
  <div class="row mt-5">
    <div class="col-12">
      <?php
      /**
       * woocommerce_after_single_product_summary hook.
       *
       * @hooked woocommerce_output_product_data_tabs - 10
       * @hooked woocommerce_upsell_display - 15
       * @hooked woocommerce_output_related_products - 20
       */
      do_action( 'woocommerce_after_single_product_summary' );
      ?>
    </div>
  </div>

</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
