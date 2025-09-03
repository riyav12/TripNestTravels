<?php
get_header();

// Get the '404 Content' page by title
$page = get_page_by_title('404 Content');
$page_id = $page ? $page->ID : null;

// Get ACF fields
$title = get_field('title_404', $page_id);
$text  = get_field('text_404', $page_id);
$cta   = get_field('link_404', $page_id);
?>

<section class="content-area">
  <div class="container">
    <div class="error-404 not-found text-center py-5">
      <?php if ($title): ?>
        <h1 class="mb-4"><?php echo esc_html($title); ?></h1>
      <?php endif; ?>

      <?php if ($text): ?>
        <div class="wysiwyg-content mb-4">
          <?php echo wp_kses_post($text); ?>
        </div>
      <?php endif; ?>

      <?php if ($cta): ?>
        <a class="btn btn-primary"
           href="<?php echo esc_url($cta['url']); ?>"
           target="<?php echo esc_attr($cta['target'] ?: '_self'); ?>">
          <?php echo esc_html($cta['title']); ?>
        </a>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
