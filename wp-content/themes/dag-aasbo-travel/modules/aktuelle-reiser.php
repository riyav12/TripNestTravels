<section class="reise-cards my-5 aktuelle-reiser">
  <div class="container">
    
    <!-- Section Title -->
    <div class="text-center mb-4">
      <h2 class="fw-bold">Aktuelle reiser</h2>
      <p class="text-muted mb-0">
        Vi har samlet kommende og populære reiser nedenfor.<br>
        Dette er bare et utvalg, <a href="#">klikk her for å se alle våre reiser.</a>
      </p>
    </div>

    <!-- Cards Grid -->
    <div class="row">
      <?php if (have_rows('reise_cards')): ?>
        <?php while (have_rows('reise_cards')): the_row();
          $image = get_sub_field('image');
          $type_icon = get_sub_field('type_icon');
          $type_label = get_sub_field('type_label');
          $status_badge = get_sub_field('status_badge');
          $title = get_sub_field('title');
          $location = get_sub_field('location');
          $date = get_sub_field('date');
          $departure = get_sub_field('departure');
        ?>
          <div class="col-12 col-sm-6 col-lg-3">
            <div class="reise-card rounded overflow-hidden bg-white h-100 position-relative">
              <div class="reise-image-wrapper position-relative">
                <?php if ($image): ?>
                  <img src="<?= esc_url($image['url']); ?>" class="img-fluid w-100" alt="<?= esc_attr($image['alt']); ?>">
                <?php endif; ?>

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
                <?php if ($title): ?>
                  <p class="fw-semibold mb-1 reise-title"><?= esc_html($title); ?></p>
                <?php endif; ?>

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
        <?php endwhile; ?>
      <?php endif; ?>
    </div>

    <?php
    $button_text = get_field('button_text');
    $button_link = get_field('button_link');
    if ($button_text && $button_link): ?>
      <div class="text-center mt-4">
  <a href="<?= home_url('/alle-reiser'); ?>" class="btn btn-primary reise-btn">
    Se alle reiser
  </a>
</div>

    <?php endif; ?>
  </div>
</section>
