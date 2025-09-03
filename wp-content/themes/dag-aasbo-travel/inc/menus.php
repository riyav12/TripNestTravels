<?php
function dagasbo_register_menus() {
  register_nav_menus([
    'primary' => __('Primary Menu', 'dagasbo'),
  ]);
}
add_action('init', 'dagasbo_register_menus');

register_nav_menus(array(
  'footer_menu' => __('Footer Menu', 'dagasbo'),
));
