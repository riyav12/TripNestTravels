<!-- Unique Sales Points -->
<section class="usp-wrapper my-4">
  <ul class="usp list-unstyled d-flex flex-wrap justify-content-center gap-4 gap-md-5">

    <?php if (have_rows('usps')): ?>
      <?php while (have_rows('usps')): the_row(); 
        $icon = get_sub_field('icon');
        $text = get_sub_field('text');
        $icon_url = is_array($icon) && isset($icon['url']) ? esc_url($icon['url']) : '';
        $alt = is_array($icon) && isset($icon['alt']) ? esc_attr($icon['alt']) : esc_attr(__('USP Icon', 'dagasbo'));
      ?>

        <?php if ($icon_url || $text): ?>
          <li class="usp-item d-flex align-items-center">
            <?php if ($icon_url): ?>
              <img src="<?php echo $icon_url; ?>" alt="<?php echo $alt; ?>" class="usp-icon" />
            <?php endif; ?>
            <?php if ($text): ?>
              <span class="small text-muted ms-2"><?php echo esc_html($text); ?></span>
            <?php endif; ?>
          </li>
        <?php endif; ?>

      <?php endwhile; ?>
    <?php endif; ?>

  </ul>
</section>
