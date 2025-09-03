<?php
/**
 * About Section (with ACF)
 */
$badge = get_acf_field('about_badge_text');
$heading = get_acf_field('about_heading');
$para1 = get_acf_field('about_para_1');
$para2 = get_acf_field('about_para_2');
$para3 = get_acf_field('about_para_3');

?>

<section class="container py-5 about-section">
  <div class="row g-4 align-items-start">

    <!-- Left Column -->
    <div class="col-md-6">
      <?php if (!empty($badge)): ?>
        <span class="badge text-bg-light mb-2">
          <?= esc_html($badge); ?>
        </span>
      <?php endif; ?>

      <?php if (!empty($heading)): ?>
        <h1 class="fw-bold display-5">
          <?= nl2br(esc_html($heading)); ?>
        </h1>
      <?php endif; ?>
    </div>

    <!-- Right Column -->
    <div class="col-md-6">
      <?php if (!empty($para1)): ?>
        <div class="about-wysiwyg ">
          <?= wp_kses_post($para1); ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($para2)): ?>
        <div class="about-wysiwyg ">
          <?= wp_kses_post($para2); ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($para3)): ?>
        <div class="about-wysiwyg">
          <?= wp_kses_post($para3); ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
