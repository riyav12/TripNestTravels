<?php
/*
Template Name: Homepage
*/
get_header();

get_template_part('modules/hero');
get_template_part('modules/destinations');
get_template_part('modules/contact');
get_template_part('modules/usp');
get_template_part('modules/aktuelle-reiser');
get_template_part('modules/destinasjoner');
get_template_part('modules/group-help');
get_template_part('modules/about');
get_template_part('modules/testimonials');
get_template_part('modules/reise-fra');
get_template_part('modules/cruise-info');


?>

<section class="product-categories-slider container py-5">
  <h2 class="text-center mb-4">Popular Categories</h2>

  <div class="position-relative">
    <div class="swiper category-swiper">
      <div class="swiper-wrapper">
        <?php
        $args = array(
          'taxonomy'   => 'product_cat',
          'orderby'    => 'name',
          'order'      => 'ASC',
          'hide_empty' => false,
          'number'     => 7
        );
        $product_categories = get_terms($args);

        foreach ($product_categories as $category) {
          $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
          $image_url = wp_get_attachment_url($thumbnail_id);
          $category_link = get_term_link($category);

          // fallback image
          if (!$image_url) {
            $image_url = get_template_directory_uri() . '/images/placeholder.jpg';
          }
          ?>
          <div class="swiper-slide">
            <a href="<?php echo esc_url($category_link); ?>" class="category-box d-block text-white text-decoration-none" style="background-image: url('<?php echo esc_url($image_url); ?>');">
              <div class="category-overlay d-flex align-items-end p-3 h-100">
                <h5 class="m-0"><?php echo esc_html($category->name); ?></h5>
              </div>
            </a>
          </div>
        <?php } ?>
      </div>
    </div>

    <!-- Arrows -->
    <div class="swiper-button-prev custom-arrow"></div>
    <div class="swiper-button-next custom-arrow"></div>
  </div>

  <!-- Purple Shop Now Button -->
  <div class="text-center mt-4">
    <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="button alt" style="padding: 10px 20px; background-color: #96588a; color: #fff; border: none; border-radius: 4px; text-decoration:none;">Shop Now</a>
  </div>
</section>





<?php get_footer(); ?>
