<?php
// Theme setup function
function theme_setup() {
    // Add support for title tag
    add_theme_support('title-tag');

    // Add support for post thumbnails
    add_theme_support('post-thumbnails');

    // Register a primary menu
    register_nav_menus([
        'primary' => __('Primary Menu', 'your-theme-textdomain'),
    ]);
    
    // Add theme support for HTML5 markup
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Add theme support for custom logo
    add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'theme_setup');

// Enqueue styles and scripts
function theme_enqueue_assets() {
    // Enqueue main stylesheet
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/assets/style/style.css', [], '1.0');

    // Enqueue JavaScript file
    wp_enqueue_script('theme-script', get_template_directory_uri() . '/assets/js/common.js', [], '1.0', true);
    
    // Black Template Assets
    // Enqueue Google Fonts
    wp_enqueue_style('black-google-fonts', 'https://fonts.googleapis.com/css?family=Inconsolata:400,700', array(), null);
    
    // Enqueue CSS files
    wp_enqueue_style('black-animate', get_template_directory_uri() . '/common/css/animate.css', array(), '1.0');
    wp_enqueue_style('black-icomoon', get_template_directory_uri() . '/common/css/icomoon.css', array(), '1.0');
    wp_enqueue_style('black-simple-line-icons', get_template_directory_uri() . '/common/css/simple-line-icons.css', array(), '1.0');
    wp_enqueue_style('black-bootstrap', get_template_directory_uri() . '/common/css/bootstrap.css', array(), '1.0');
    wp_enqueue_style('black-style', get_template_directory_uri() . '/common/css/style.css', array(), '1.0');
    
    // Enqueue JavaScript files - in footer
    wp_enqueue_script('black-modernizr', get_template_directory_uri() . '/common/js/modernizr-2.6.2.min.js', array(), '2.6.2', false);
    wp_enqueue_script('black-respond', get_template_directory_uri() . '/common/js/respond.min.js', array(), '1.0', true);
    wp_enqueue_script('black-jquery', get_template_directory_uri() . '/common/js/jquery.min.js', array(), '1.0', true);
    wp_enqueue_script('black-jquery-easing', get_template_directory_uri() . '/common/js/jquery.easing.1.3.js', array('jquery'), '1.3', true);
    wp_enqueue_script('black-bootstrap-js', get_template_directory_uri() . '/common/js/bootstrap.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('black-waypoints', get_template_directory_uri() . '/common/js/jquery.waypoints.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('black-stellar', get_template_directory_uri() . '/common/js/jquery.stellar.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('black-countTo', get_template_directory_uri() . '/common/js/jquery.countTo.js', array('jquery'), '1.0', true);
    wp_enqueue_script('black-main', get_template_directory_uri() . '/common/js/main.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_assets');

// Register widget areas
function theme_widgets_init() {
    register_sidebar([
        'name'          => __('Sidebar', 'your-theme-textdomain'),
        'id'            => 'sidebar-1',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);
}
add_action('widgets_init', 'theme_widgets_init');

// REST API settings

add_filter('rest_authentication_errors', '__return_false');

add_action('init', function() {
    header("Access-Control-Allow-Origin: *");
});

