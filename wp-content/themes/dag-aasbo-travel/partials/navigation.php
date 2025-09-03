<header class="site-header bg-white">
  <nav class="navbar navbar-expand-md navbar-light py-3">
    <div class="container">

      <!-- Logo -->
      <a class="navbar-brand site-logo" href="<?php echo home_url(); ?>">
        <img src="<?php echo get_theme_image_url('logo1.png'); ?>" alt="Trip Nest">
      </a>

      <!-- Mobile Toggle -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenu"
        aria-controls="mainMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Menu + WooCommerce Links -->
      <div class="collapse navbar-collapse justify-content-end main-menu-wrapper" id="mainMenu">
        <?php
        $menu = get_transient('primary_menu_cache');

        if ($menu === false) {
          $menu = wp_nav_menu([
            'theme_location' => 'primary',
            'menu_class'     => 'navbar-nav',
            'container'      => false,
            'fallback_cb'    => false,
            'depth'          => 2,
            'walker'         => class_exists('WP_Bootstrap_Navwalker') ? new WP_Bootstrap_Navwalker() : '',
            'echo'           => false
          ]);

          set_transient('primary_menu_cache', $menu, 12 * HOUR_IN_SECONDS);
        }

        echo $menu;
        ?>

        <!-- WooCommerce Account/Login/Cart/Wishlist Links -->
        <ul class="navbar-nav ms-3 align-items-center">
          <?php if ( class_exists( 'WooCommerce' ) ) : ?>
            <?php if ( is_user_logged_in() ) : ?>

              <!-- My Account -->
              <li class="nav-item">
                <a class="nav-link" href="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ); ?>">
                  <i class="fas fa-user"></i> My Account
                </a>
              </li>

              <!-- Wishlist -->
              <li class="nav-item wishlist-icon">
                <a class="nav-link position-relative" href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url() ); ?>">
                  <i class="fas fa-heart"></i>
                  <?php if ( function_exists( 'yith_wcwl_count_products' ) ) : ?>
                    <?php $count = yith_wcwl_count_products(); ?>
                    <?php if ( $count > 0 ) : ?>
                      <span class="wishlist-count"><?php echo esc_html( $count ); ?></span>
                    <?php endif; ?>
                  <?php endif; ?>
                </a>
              </li>

              <!-- Cart -->
              <li class="nav-item">
                <a class="nav-link" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
                  <i class="fas fa-shopping-cart"></i>
                  Cart (<span class="woocommerce-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>)
                </a>
              </li>

              <!-- Checkout -->
              <li class="nav-item">
                <a class="nav-link" href="<?php echo esc_url( wc_get_checkout_url() ); ?>">
                  <i class="fas fa-credit-card"></i> Checkout
                </a>
              </li>

              <!-- Logout -->
              <li class="nav-item">
                <a class="nav-link" href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>">
                  <i class="fas fa-sign-out-alt"></i> Logout
                </a>
              </li>

            <?php else : ?>

              <!-- Login -->
              <li class="nav-item">
                <a class="nav-link" href="<?php echo esc_url( wp_login_url() ); ?>">
                  <i class="fas fa-sign-in-alt"></i> Login
                </a>
              </li>

            <?php endif; ?>
          <?php endif; ?>
        </ul>

      </div>
    </div>
  </nav>
</header>
