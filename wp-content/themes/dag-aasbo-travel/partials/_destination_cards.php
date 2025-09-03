<?php
$args = array(
  'post_type' => 'destination',
  'posts_per_page' => -1
);

$query = new WP_Query($args);

if ($query->have_posts()) :
  while ($query->have_posts()) : $query->the_post();
    $country = get_field('country_name');
    $transport = get_field('transport_type'); // 'fly', 'buss', etc.
    $image = get_field('destination_image');
?>
  <div class="col-12 col-md-4 isotope-item <?php echo esc_attr($transport); ?>">
    <div class="destination-card position-relative rounded overflow-hidden">
      <?php if ($image): ?>
        <img src="<?php echo esc_url($image); ?>" class="destination-img w-100 img-fluid rounded" alt="<?php the_title(); ?>">
      <?php else: ?>
        <div class="no-image-box bg-light d-flex align-items-center justify-content-center">
          <span class="text-muted"><?php _e('No image available', 'dagasbo'); ?></span>
        </div>
      <?php endif; ?>
      <div class="info-box position-absolute bottom-0 start-0 m-3 rounded shadow-sm">
        <p class="country-name">
          <?php echo esc_html($country); ?>
        </p>
        <p class="destination-title">
          <?php the_title(); ?>
        </p>
      </div>
    </div>
  </div>
<?php
  endwhile;
else :
?>
  <div class="col-12 text-center text-muted">
    <?php _e('Ingen destinasjoner funnet.', 'dagasbo'); ?>
  </div>
<?php
endif;
wp_reset_postdata();
