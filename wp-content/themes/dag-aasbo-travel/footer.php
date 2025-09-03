<footer class="site-footer pt-5 pb-3">
  <div class="container">
    <div class="row">

      <!-- Column 1: Logo + Text -->
      <div class="col-lg-3 mb-4 mb-lg-0">
        <?php $logo = get_field('footer_logo', 'option'); ?>
        <?php if ($logo): ?>
          <img src="<?php echo get_theme_image_url('logo1.png'); ?>" alt="Trip Nest" class="mb-3 footer-logo">
        <?php endif; ?>

        <?php $desc = get_field('footer_description', 'option'); ?>
        <?php if ($desc): ?>
          <div class="footer-wysiwyg">
            <?php echo wp_kses_post($desc); ?>
          </div>
        <?php endif; ?>

        <?php if (have_rows('footer_buttons', 'option')): ?>
          <div class="d-flex gap-2 flex-wrap mt-3">
            <?php while (have_rows('footer_buttons', 'option')): the_row(); ?>
              <a href="<?php the_sub_field('link'); ?>" class="footer-link-btn <?php the_sub_field('style'); ?>">
                <?php the_sub_field('label'); ?>
              </a>
            <?php endwhile; ?>
          </div>
        <?php endif; ?>
      </div>

      <!-- Footer Columns -->
      <?php if (have_rows('footer_columns', 'option')): ?>
        <?php while (have_rows('footer_columns', 'option')): the_row(); ?>
          <div class="footer-column pl-22">
            <h4 class="ml-7 fs-15"><?php the_sub_field('heading'); ?></h4>
            <ul class="footer-links">
              <?php if (have_rows('links')): ?>
                <?php while (have_rows('links')): the_row(); ?>
                  <li><a href="<?php the_sub_field('url'); ?>"><?php the_sub_field('text'); ?></a></li>
                <?php endwhile; ?>
              <?php endif; ?>
            </ul>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>

    </div>

    <hr class="border-light my-4">

    <div class="text-center small">
      &copy; <?php echo date('Y'); ?> <?php the_field('footer_copyright', 'option'); ?>
    </div>
  </div>
</footer>

<?php if (!is_user_logged_in()) : ?>
  <div id="discount-popup" class="discount-popup" style="display:none;">
    <div class="popup-content">
      <span class="close-popup" id="popup-close">&times;</span>
      <img src="<?php echo get_template_directory_uri(); ?>/images/flowers.jpg" alt="Flowers" class="popup-image" />
      <div class="popup-text">
        <h3>Would you like a 15% discount on your first order?</h3>
        <p>Leave your email address below and we’ll send you a discount code by email.</p>
        <form id="discount-form">
          <input type="email" placeholder="Your email" required />
          <label>
            <input type="checkbox" required /> Yes, send me newsletters.
          </label>
          <button type="submit">I’m in!</button>
        </form>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
