<?php
$image = get_field('image');
$type_icon = get_field('type_icon');
$type_label = get_field('type_label');
$status_badge = get_field('status_badge');
$location = get_field('location');
$date = get_field('date');
$departure = get_field('departure');
?>

<div class="col-12 col-sm-6 col-lg-3">
  <div class="reise-card rounded overflow-hidden bg-white h-100 position-relative">
    <div class="reise-image-wrapper position-relative">
      <?php
    $placeholder = get_template_directory_uri() . '/assets/images/placeholder.jpg';
    $image_url = $image ? esc_url($image['url']) : $placeholder;
    $image_alt = $image ? esc_attr($image['alt']) : 'Placeholder Image';
    ?>
<img src="<?= $image_url; ?>" class="img-fluid w-100" alt="<?= $image_alt; ?>">


      <div class="badge-wrapper position-absolute top-0 start-0 m-2 d-flex flex-column gap-1">
        <?php if ($type_label): ?>
          <span class="badge reise-badge">
            <?php if ($type_icon): ?>
              <img src="<?= esc_url($type_icon['url']); ?>" width="16" class="me-1" alt="icon">
            <?php endif; ?>
            <?= esc_html($type_label); ?>
          </span>
        <?php endif; ?>

        <?php if ($status_badge): ?>
          <span class="badge reise-badge"><?= esc_html($status_badge); ?></span>
        <?php endif; ?>
      </div>
    </div>

    <div class="p-2">
      <p class="fw-semibold mb-1 reise-title"><?= get_the_title(); ?></p>

      <?php if ($location): ?>
        <p class="text-muted small mb-1">
          <img src="<?= get_template_directory_uri(); ?>/assets/images/icons/location.svg" width="16" class="me-1" alt="Location">
          <?= esc_html($location); ?>
        </p>
      <?php endif; ?>

      <?php if ($date): ?>
        <p class="text-muted small mb-1">
          <img src="<?= get_template_directory_uri(); ?>/assets/images/icons/calender.svg" width="16" class="me-1" alt="Calendar">
          <?= esc_html($date); ?>
        </p>
      <?php endif; ?>

      <?php if ($departure): ?>
        <p class="text-muted small">
          <img src="<?= get_template_directory_uri(); ?>/assets/images/icons/takeoff.svg" width="16" class="me-1" alt="Departure">
          <?= esc_html($departure); ?>
        </p>
      <?php endif; ?>
    </div>
  </div>
</div>
