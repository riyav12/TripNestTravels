<section class="container py-5 testimonials">
  <div class="row g-4 align-items-stretch">
    <?php if (have_rows('testimonials')) :
      $index = 0;
      while (have_rows('testimonials')) : the_row();
        $text = get_sub_field('testimonial_text');
        $name = get_sub_field('name');
        $image = get_sub_field('image');

        // Check if it's a text block or image block based on index (0,1,2,...)
        if ($index % 2 === 1) : // image column
    ?>
          <div class="col-md-4 d-flex">
            <?php if ($image) :
              echo wp_get_attachment_image($image['ID'], 'full', false, [
                'class' => 'img-fluid rounded w-100 h-100 object-fit-cover',
                'alt' => esc_attr($name ?: 'Customer'),
              ]);
            else : ?>
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.jpg" class="img-fluid rounded w-100 h-100 object-fit-cover" alt="Placeholder">
            <?php endif; ?>
          </div>
        <?php else : // text column ?>
          <div class="col-md-4 d-flex">
            <div class="testimonial-card bg-light-blue rounded p-4 w-100 d-flex flex-column justify-content-between">
              <div class="testimonial-wysiwyg">
                <?php echo apply_filters('the_content', $text); ?>
              </div>
              <small class="text-muted testimonial-name"><?php echo esc_html($name); ?></small>
            </div>
          </div>
        <?php endif;
        $index++;
      endwhile;
    endif; ?>
  </div>
</section>
