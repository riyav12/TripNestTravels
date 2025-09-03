<section class="hero">
  <?php
    $hero_bg = get_field('hero_bg');
    $hero_subtitle = get_field('hero_subtitle');
    $hero_title = get_field('hero_title');
    $hero_rating_img = get_field('hero_rating_img');
    $search_placeholder = get_field('hero_search_placeholder');

    $hero_bg_url = is_array($hero_bg) ? esc_url($hero_bg['url']) : esc_url($hero_bg);
    if (empty($hero_bg_url)) {
      $hero_bg_url = get_template_directory_uri() . '/assets/images/placeholder-bg.jpg';
    }
  ?>

  <div class="container hero-bg" style="--hero-bg: url('<?php echo $hero_bg_url; ?>');">
    <div class="hero-overlay text-center text-white px-3">
      <?php if (!empty($hero_subtitle)) : ?>
        <p class="hero-subtitle small mb-2">
          <?php echo esc_html($hero_subtitle); ?>
        </p>
      <?php endif; ?>

      <?php if (!empty($hero_title)) : ?>
  <div class="hero-wysiwyg ">
    <?php echo wp_kses_post($hero_title); ?>
  </div>
<?php endif; ?>


      <?php if (!empty($hero_rating_img)) : ?>
        <div class="d-flex justify-content-center align-items-center mb-3 gap-2">
          <?php echo wp_get_attachment_image($hero_rating_img['ID'], 'full', false, [
            'class' => 'trustpilot-img',
            'alt'   => __('Trustpilot Stars', 'dagasbo')
          ]); ?>
        </div>
      <?php endif; ?>

      <div class="input-group search-bar shadow overflow-hidden mx-auto">
        <span class="input-group-text">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/search-lg.svg"
               alt="<?php _e('Search', 'dagasbo'); ?>" class="search-icon" />
        </span>
        <input type="text" class="form-control"
               placeholder="<?php echo esc_attr($search_placeholder ?: __('Hvor ønsker du å reise?', 'dagasbo')); ?>" />
      </div>
    </div>
  </div>
</section>
