<?php get_header(); ?>

<section class="reise-cards my-5 aktuelle-reiser">
  <div class="container">
    <div class="text-center mb-4">
      <h2 class="fw-bold">Alle reiser</h2>
      <p class="text-muted mb-0">
        Her finner du alle våre reiser. Bruk "Load More" for å se flere turer.
      </p>
    </div>

    <div class="row gy-5" id="reise-posts">
      <?php
      $args = ['post_type' => 'reise', 'posts_per_page' => 8];
      $query = new WP_Query($args);
      if ($query->have_posts()):
        while ($query->have_posts()): $query->the_post();
          get_template_part('template-parts/content', 'reise');
        endwhile;
        wp_reset_postdata();
      endif;
      ?>
    </div>

    <div class="text-center mt-4">
      <button id="load-more-reise" class="btn btn-primary px-4 py-2 rounded-pill">Load More</button>
    </div>
  </div>
</section>

<?php get_footer(); ?>
