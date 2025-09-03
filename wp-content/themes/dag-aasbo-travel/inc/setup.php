<?php
// Theme setup
function dagasbo_theme_setup() {
    load_theme_textdomain('dagasbo', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
}
add_action('after_setup_theme', 'dagasbo_theme_setup');


function dagasbo_acf_options_page() {
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page([
            'page_title' => 'Theme Options',
            'menu_title' => 'Theme Options',
            'menu_slug'  => 'theme-options',
            'capability' => 'edit_posts',
            'redirect'   => false
        ]);
    }
}
add_action('acf/init', 'dagasbo_acf_options_page');


function get_acf_field($field_name) {
  return function_exists('get_field') ? get_field($field_name) : '';
}
function get_theme_image_url($relative_path) {
    return get_template_directory_uri() . '/assets/images/' . ltrim($relative_path, '/');
}



