<?php
/**
 * Template Part: Group Travel Help Section
 */
$image = get_field('group_help_image'); // Image is now an array
$heading = get_field('group_help_title');
$description = get_field('group_help_description');
$cards = get_field('group_help_cards');
?>

<section class="container py-5 group-help">
  <div class="row g-4 align-items-stretch">

    <!-- Left Image -->
    <div class="col-md-6 d-flex">
      <?php if (!empty($image)): ?>
        <?php echo wp_get_attachment_image($image['ID'], 'full', false, [
          'class' => 'img-fluid rounded w-100 h-100 object-fit-cover group-image',
          'alt' => esc_attr($image['alt'] ?: 'Group travel info')
        ]); ?>
      <?php endif; ?>
    </div>

    <!-- Right Content -->
    <div class="col-md-6 d-flex">
      <div class="bg-light-blue d-flex flex-column w-100">

        <!-- Top Heading -->
        <?php if ($heading): ?>
          <h2 class="fw-bold mb-3 text-center group-title">
            <?php echo esc_html($heading); ?>
          </h2>
        <?php endif; ?>

        <?php if ($description): ?>
  <div class="group-wysiwyg mb-4 text-center">
    <?php echo wp_kses_post($description); ?>
  </div>
<?php endif; ?>


        <!-- Cards -->
        <div class="flex-grow-1 d-flex flex-column justify-content-around gap-3">
          <!-- Card 1 -->
          <?php if (!empty($cards['card_1_title'])): ?>
            <div class="bg-white rounded shadow-sm p-3 info-card">
              <h6 class="fw-semibold mb-1"><?php echo esc_html($cards['card_1_title']); ?></h6>
              <p class="text-muted small mb-2"><?php echo nl2br(esc_html($cards['card_1_description'])); ?></p>
              <a href="#" class="btn btn-sm btn-primary"><?php _e('Les mer', 'dagasbo'); ?></a>
            </div>
          <?php endif; ?>

          <!-- Card 2 -->
          <?php if (!empty($cards['card_2_title'])): ?>
            <div class="bg-white rounded shadow-sm p-3 info-card">
              <h6 class="fw-semibold mb-1"><?php echo esc_html($cards['card_2_title']); ?></h6>
              <p class="text-muted small mb-2"><?php echo nl2br(esc_html($cards['card_2_description'])); ?></p>
              <a href="#" class="btn btn-sm btn-primary"><?php _e('Les mer', 'dagasbo'); ?></a>
            </div>
          <?php endif; ?>

          <!-- Card 3 -->
          <?php if (!empty($cards['card_3_title'])): ?>
            <div class="bg-white rounded shadow-sm p-3 opacity-50 info-card mb-0">
              <h6 class="fw-semibold mb-1"><?php echo esc_html($cards['card_3_title']); ?></h6>
              <p class="text-muted small mb-0"><?php echo nl2br(esc_html($cards['card_3_description_'])); ?></p>
            </div>
          <?php endif; ?>
        </div>

      </div>
    </div>
  </div>
</section>
