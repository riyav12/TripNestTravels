<?php
/**
 * Template part: Hvor skal du reise fra Section (ACF Enabled with Repeater)
 */

// Get ACF Fields
$image = get_field('reise_fra_image'); // returns full image array
$heading = get_field('reise_fra_heading');
$description = get_field('reise_fra_description');
?>

<section class="container py-5 reise-fra">
  <div class="row align-items-center g-5">

    <!-- Left Image -->
    <div class="col-sm-6">
      <?php
      if ($image && isset($image['ID'])) {
        echo wp_get_attachment_image(
          $image['ID'],
          'full', 
          false,
          [
            'class' => 'img-fluid rounded',
            'alt'   => esc_attr($image['alt'] ?? '')
          ]
        );
      }
      ?>
    </div>

    <!-- Right Text -->
    <div class="col-sm-6 ps-md-5">
      <?php if ($heading): ?>
        <h2 class="mb-3">
          <?php echo esc_html($heading); ?>
        </h2>
      <?php endif; ?>

      <?php if ($description): ?>
  <div class="acf-wysiwyg">
    <?php echo apply_filters('the_content', $description); ?>
  </div>
<?php endif; ?>


      <?php if ( have_rows('reise_fra_links') ): ?>
        <ul>
          <?php while ( have_rows('reise_fra_links') ): the_row(); 
            $text = get_sub_field('text');
            $url = get_sub_field('url');
          ?>
            <?php if ($text && $url): ?>
              <li><a href="<?php echo esc_url($url); ?>"><?php echo esc_html__($text, 'dagasbo'); ?></a></li>
            <?php endif; ?>
          <?php endwhile; ?>
        </ul>
      <?php endif; ?>
    </div>

  </div>
</section>
