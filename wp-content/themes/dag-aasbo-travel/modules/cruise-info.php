<?php
/**
 * Template Part: Cruise Info Section
 */

$heading = get_field('cruise_heading');
$paragraph1 = get_field('cruise_paragraph1');
$paragraph2 = get_field('cruise_paragraph2');
$button_text = get_field('cruise_button_text');
$button_url = get_field('cruise_button_url');
$image = get_field('cruise_image'); // now using Image Array
?>

<section class="container py-5 cruise-section">
  <div class="row g-4 align-items-center">

    <!-- Left Column: Text -->
    <div class="col-md-6">
      <?php if ($heading): ?>
        <h2 class="fw-semibold mb-3"><?php echo esc_html($heading); ?></h2>
      <?php endif; ?>

       <?php if ($paragraph1): ?>
        <div class="cruise-wysiwyg">
          <?php echo apply_filters('the_content', $paragraph1); ?>
        </div>
      <?php endif; ?>

       <?php if ($paragraph2): ?>
        <div class="cruise-wysiwyg ">
          <?php echo apply_filters('the_content', $paragraph2); ?>
        </div>
      <?php endif; ?>


      <?php if ($button_text && $button_url): ?>
        <a href="<?php echo esc_url($button_url); ?>" class="btn btn-primary">
          <?php echo esc_html($button_text); ?>
        </a>
      <?php endif; ?>
    </div>

    <!-- Right Column: Image -->
    <div class="col-md-6">
      <?php
      if (!empty($image) && !empty($image['ID'])) {
        echo wp_get_attachment_image($image['ID'], 'full', false, [
          'class' => 'img-fluid rounded',
          'alt'   => esc_attr($image['alt'] ?? 'Cruise Image')
        ]);
      }
      ?>
    </div>

  </div>
</section>
