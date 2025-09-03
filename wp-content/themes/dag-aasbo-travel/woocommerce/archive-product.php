<?php
defined('ABSPATH') || exit;

get_header('shop');
?>

<div class="container my-5">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-3">
      <?php get_template_part('partials/sidebar', 'shop'); ?>
    </div>

    <!-- Products Area -->
    <div class="col-md-9">
      <div id="ajax-products">
        <?php if (woocommerce_product_loop()) : ?>
          <ul class="products row gx-4 gy-5">
            <?php while (have_posts()) : the_post(); ?>
              <?php wc_get_template_part('content', 'product'); ?>
            <?php endwhile; ?>
          </ul>
        <?php else : ?>
          <?php do_action('woocommerce_no_products_found'); ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php get_footer('shop'); ?>
