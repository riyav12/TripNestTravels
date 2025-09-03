<?php

// Enqueue Styles and Scripts
function dagasbo_enqueue_assets() {
    // Bootstrap CSS
    wp_enqueue_style(
        'bootstrap-css',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css',
        [],
        '5.3.2'
    );

    // FontAwesome
    wp_enqueue_style(
        'fontawesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
        [],
        '6.4.0'
    );

    // Main compiled CSS
    wp_enqueue_style(
        'main-style',
        get_template_directory_uri() . '/assets/css/main.css',
        ['bootstrap-css'],
        '1.0'
    );

    // Custom Theme Style
    wp_enqueue_style(
        'dagasbo-style',
        get_template_directory_uri() . '/assets/css/style.css',
        ['main-style'],
        '1.0'
    );

    // Bootstrap JS
    wp_enqueue_script(
        'bootstrap-js',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
        [],
        '5.3.2',
        true
    );

    // Isotope Library
    wp_enqueue_script(
        'isotope',
        'https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js',
        [],
        '3.0.6',
        true
    );

    // Custom Isotope Script
    wp_enqueue_script(
        'custom-filter',
        get_template_directory_uri() . '/assets/js/isotope-filter.js',
        ['isotope'],
        '1.0',
        true
    );

    // AJAX Product Filter Script
    wp_enqueue_script(
        'ajax-product-filter',
        get_template_directory_uri() . '/assets/js/ajax-filter.js',
        ['jquery'],
        '1.0',
        true
    );

    // Pass AJAX URL to JS
    wp_localize_script('ajax-product-filter', 'my_ajax_object', [
        'ajax_url' => admin_url('admin-ajax.php'),
    ]);
}
add_action('wp_enqueue_scripts', 'dagasbo_enqueue_assets');

// ACF JSON Paths
add_filter('acf/settings/save_json', function ($path) {
    return get_stylesheet_directory() . '/acf-json';
});
add_filter('acf/settings/load_json', function ($paths) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
});

// Register Destinations CPT
function register_custom_post_type_destinations() {
    register_post_type('destination', [
        'labels' => [
            'name' => __('Destinasjoner', 'dagasbo'),
            'singular_name' => __('Destinasjon', 'dagasbo'),
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'destinasjoner'],
        'supports' => ['title', 'editor', 'thumbnail'],
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-location-alt',
    ]);
}
add_action('init', 'register_custom_post_type_destinations');

// WooCommerce Support
add_theme_support('woocommerce');

// AJAX Product Filter Hooks
add_action('wp_ajax_filter_products', 'filter_products_callback');
add_action('wp_ajax_nopriv_filter_products', 'filter_products_callback');

// AJAX Filter Callback
function filter_products_callback() {
    $colors = !empty($_POST['colors']) ? json_decode(stripslashes($_POST['colors'])) : [];
    $sizes  = !empty($_POST['sizes']) ? json_decode(stripslashes($_POST['sizes'])) : [];
    $min_price = isset($_POST['min_price']) ? floatval($_POST['min_price']) : 0;
    $max_price = isset($_POST['max_price']) ? floatval($_POST['max_price']) : 999999;
    $stock_status = isset($_POST['stock_status']) ? sanitize_text_field($_POST['stock_status']) : '';

    $args = [
        'post_type' => 'product',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'meta_query' => [
            [
                'key' => '_price',
                'value' => [$min_price, $max_price],
                'compare' => 'BETWEEN',
                'type' => 'NUMERIC'
            ]
        ]
    ];

    if ($stock_status === 'instock') {
        $args['meta_query'][] = [
            'key' => '_stock_status',
            'value' => 'instock',
            'compare' => '='
        ];
    }

    $tax_query = [];

    if (!empty($colors)) {
        $tax_query[] = [
            'taxonomy' => 'pa_color',
            'field' => 'slug',
            'terms' => $colors,
        ];
    }

    if (!empty($sizes)) {
        $tax_query[] = [
            'taxonomy' => 'pa_size',
            'field' => 'slug',
            'terms' => $sizes,
        ];
    }

    if (!empty($tax_query)) {
        $tax_query['relation'] = 'AND';
        $args['tax_query'] = $tax_query;
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        woocommerce_product_loop_start();
        while ($query->have_posts()) {
            $query->the_post();
            wc_get_template_part('content', 'product');
        }
        woocommerce_product_loop_end();
    } else {
        echo '<p>No products found matching your selection.</p>';
    }

    wp_reset_postdata();
    wp_die();
}
// In functions.php
function custom_enqueue_scripts() {
    wp_enqueue_script('jquery-ui-slider');

    wp_enqueue_script('ajax-filter', get_template_directory_uri() . '/assets/js/ajax-filter.js', ['jquery', 'jquery-ui-slider'], '1.0', true);

    wp_localize_script('ajax-filter', 'my_ajax_object', [
        'ajax_url' => admin_url('admin-ajax.php')
    ]);

    wp_enqueue_style('jquery-ui-style', 'https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css');
}
add_action('wp_enqueue_scripts', 'custom_enqueue_scripts');



add_filter( 'woocommerce_valid_order_statuses_for_cancel', 'custom_cancel_order_statuses', 10, 2 );
function custom_cancel_order_statuses( $statuses, $order ) {
    if ( $order->has_status( 'on-hold' ) ) {
        $statuses[] = 'on-hold';
    }
    return $statuses;
}

function dag_enqueue_custom_scripts() {
    wp_enqueue_script('jquery');

    wp_enqueue_script(
        'quantity-picker',
        get_template_directory_uri() . '/assets/js/quantity-picker.js',
        array(),
        false,
        true
    );
}
add_action('wp_enqueue_scripts', 'dag_enqueue_custom_scripts');

function theme_enqueue_ajax_add_to_cart_script() {
  if (class_exists('WooCommerce')) {
    wp_enqueue_script(
      'custom-ajax-add-to-cart',
      get_template_directory_uri() . '/assets/js/ajax-add-to-cart.js',
      array('jquery'),
      '1.0',
      true
    );

    wp_localize_script('custom-ajax-add-to-cart', 'ajax_object', array(
      'ajax_url' => admin_url('admin-ajax.php'),
      'nonce'    => wp_create_nonce('ajax_add_to_cart_nonce')
    ));
  }
}
add_action('wp_enqueue_scripts', 'theme_enqueue_ajax_add_to_cart_script');

add_action('wp_ajax_ajax_add_to_cart', 'handle_ajax_add_to_cart');
add_action('wp_ajax_nopriv_ajax_add_to_cart', 'handle_ajax_add_to_cart');

function handle_ajax_add_to_cart() {
  check_ajax_referer('ajax_add_to_cart_nonce', 'nonce');

  $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
  $quantity   = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);

  $product_status = get_post_status($product_id);

  if ('publish' !== $product_status) {
    wp_send_json_error(['message' => 'Product not published']);
  }

  $added = WC()->cart->add_to_cart($product_id, $quantity);

  if ($added) {
    WC_AJAX::get_refreshed_fragments();
  } else {
    wp_send_json_error(['message' => 'Unable to add to cart.']);
  }

  wp_die();
}

// Enable WooCommerce AJAX cart count update
add_filter('woocommerce_add_to_cart_fragments', 'update_cart_count_ajax');
function update_cart_count_ajax($fragments) {
    ob_start();
    ?>
    <span class="woocommerce-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
    <?php
    $fragments['.woocommerce-cart-count'] = ob_get_clean();
    return $fragments;
}

add_action('wp_enqueue_scripts', function() {
    wp_add_inline_script('wc-add-to-cart', '
        jQuery(function($) {
            $("body").on("added_to_cart", function(event, fragments, cart_hash, $button) {
                if ($button && $button.length) {
                    $button.removeClass("loading").addClass("added");
                    $button.text("Added ✓");

                    setTimeout(function() {
                        $button.removeClass("added").text("Add to cart");
                    }, 2000);
                }
            });
        });
    ');
});

// Wishlist Count Auto Update
wp_enqueue_script(
  'wishlist-count',
  get_template_directory_uri() . '/assets/js/wishlist-count.js',
  ['jquery'],
  '1.0',
  true
);

wp_localize_script('wishlist-count', 'ajax_object', array(
  'ajax_url' => admin_url('admin-ajax.php'),
));

add_action('wp_ajax_get_wishlist_count', 'get_wishlist_count_callback');
add_action('wp_ajax_nopriv_get_wishlist_count', 'get_wishlist_count_callback');

function get_wishlist_count_callback() {
    if (function_exists('yith_wcwl_count_products')) {
        wp_send_json_success(['count' => yith_wcwl_count_products()]);
    } else {
        wp_send_json_success(['count' => 0]);
    }
}

// Auto-update cart script
add_action('wp_enqueue_scripts', function () {
    if (is_cart()) {
        wp_enqueue_script(
            'cart-auto-update',
            get_template_directory_uri() . '/assets/js/cart-auto-update.js',
            array('jquery'),
            null,
            true
        );
    }
});

// Remove "Cart updated" message on cart page
add_filter( 'woocommerce_add_message', function( $message ) {
    if ( is_cart() && strpos( strtolower( $message ), 'cart updated' ) !== false ) {
        return '';
    }
    return $message;
});

add_action('wp_enqueue_scripts', function() {
    if (class_exists('WooCommerce')) {
        wp_enqueue_script(
            'cart-fragment-refresh',
            get_template_directory_uri() . '/assets/js/cart-auto-update.js',
            ['jquery', 'wc-cart-fragments'], 
            '1.0',
            true
        );
    }
});

add_action('wp_enqueue_scripts', function () {
    if (class_exists('WooCommerce')) {
        wp_enqueue_script('wc-cart-fragments');
    }
}, 100);


function register_reise_post_type() {
  register_post_type('reise', [
    'labels' => [
      'name' => __('Reiser'),
      'singular_name' => __('Reise'),
    ],
    'public' => true,
    'has_archive' => true,
    'rewrite' => ['slug' => 'reiser'],
    'supports' => ['title', 'editor', 'thumbnail'],
    'show_in_rest' => true,
    'menu_icon' => 'dashicons-airplane',
  ]);
}
add_action('init', 'register_reise_post_type');


add_action('wp_ajax_load_more_reise', 'load_more_reise');
add_action('wp_ajax_nopriv_load_more_reise', 'load_more_reise');

function load_more_reise() {
  $paged = isset($_GET['page']) ? intval($_GET['page']) : 1;

  $args = [
    'post_type' => 'reise',
    'posts_per_page' => 8,
    'paged' => $paged,
  ];

  $query = new WP_Query($args);

  if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();
      get_template_part('template-parts/content', 'reise');
    endwhile;
  endif;

  wp_die(); // end ajax
}

function enqueue_reise_scripts() {
  // Always enqueue the script on your custom page
  if (is_page('alle-reiser') || is_post_type_archive('reise')) {
    wp_enqueue_script(
      'load-more-reise',
      get_template_directory_uri() . '/assets/js/load-more-reise.js',
      [],
      false,
      true
    );

    wp_localize_script('load-more-reise', 'reise_ajax_object', [
      'ajax_url' => admin_url('admin-ajax.php'),
    ]);
  }
}
add_action('wp_enqueue_scripts', 'enqueue_reise_scripts');


function custom_enqueue_discount_popup() {
  wp_enqueue_script('discount-popup', get_template_directory_uri() . '/assets/js/discount-popup.js', array(), null, true);
  wp_localize_script('discount-popup', 'userIsLoggedIn', array('value' => is_user_logged_in()));
}
add_action('wp_enqueue_scripts', 'custom_enqueue_discount_popup');


function show_discount_popup() {
    if (is_user_logged_in()) {
        ?>
        <div id="discount-popup" style="display: none; position: fixed; z-index: 9999; top: 20%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 30px; box-shadow: 0 0 20px rgba(0,0,0,0.2); border-radius: 10px;">
            <h2>Great things are on the horizon</h2>
            <p>Something big is brewing! Our store is in the works and will be launching soon!</p>
            <button onclick="document.getElementById('discount-popup').style.display='none'">Close</button>
        </div>
        <?php
    }
}
add_action('wp_footer', 'show_discount_popup');

// Replace price HTML conditionally for guests vs logged-in users
add_filter('woocommerce_get_price_html', 'custom_price_for_loggedin_users_only', 10, 2);

function custom_price_for_loggedin_users_only($price, $product) {
    // Skip for admin/backend
    if (is_admin()) return $price;

    // If product is on sale
    if ($product->is_on_sale()) {
        $regular_price = wc_price($product->get_regular_price());
        $sale_price = wc_price($product->get_sale_price());

        if (is_user_logged_in()) {
            // Logged-in users see both prices
            return '<del>' . $regular_price . '</del> <ins>' . $sale_price . '</ins>';
        } else {
            // Guests see only regular price
            return '<span class="price">' . $regular_price . '</span>';
        }
    }

    // If not on sale, show default price
    return $price;
}

add_filter('woocommerce_sale_flash', 'remove_sale_flash_for_guests', 10, 3);

function remove_sale_flash_for_guests($html, $post, $product) {
    if (!is_user_logged_in()) {
        return ''; // No sale badge for guests
    }
    return $html; // Keep it for logged-in users
}


function enqueue_category_slider_assets() {
    // Swiper core styles (if not already added)
    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css');

    // Swiper JS
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js', array(), null, true);

    // Custom JS
    wp_enqueue_script('category-slider', get_template_directory_uri() . '/assets/js/category-slider.js', array('swiper-js'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_category_slider_assets');


// Make phone required in billing fields
add_filter( 'woocommerce_billing_fields', function( $fields ) {
    $fields['billing_phone']['required'] = true;
    return $fields;
});

// Make city optional (affects both billing & shipping)
add_filter( 'woocommerce_default_address_fields', function( $fields ) {
    if ( isset( $fields['city'] ) ) {
        $fields['city']['required'] = false;
    }
    return $fields;
});