<?php
/**
 * Header Remove
 * 
 * WP Emoji Scripts remove
 */
// REMOVE WP EMOJI

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'wp_print_styles', 'wp-block-library-css' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

remove_action( 'wp_head', 'wp_resource_hints', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );

remove_action( 'rest_api_init', 'wp_oembed_register_route' );

function fb_remove_styles() {
    wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_enqueue_scripts', 'fb_remove_styles' );

remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );


// REST-API remove not Admin
if ( ! is_user_logged_in() ) {
   add_filter( 'rest_enabled', '_return_false' );
   add_filter( 'rest_jsonp_enabled', '_return_false' );
}

register_nav_menus( array( 'menu-1' => 'Main Menu' ) );

/**
 * Header add
 */
add_action( 'wp_enqueue_scripts', 'fb_enqueue_style' );
function fb_enqueue_style () {
    wp_enqueue_style( 'flexbasic', get_template_directory_uri() . '/style.css' );
}
   

add_theme_support( 'title-tag' );

function cc_mime_types($mimes) {
    $mimes['json'] = 'application/json';
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/**
 * Footer Remove
 */
add_action( 'wp_footer', 'fb_deregister_footer_scripts' );
function fb_deregister_footer_scripts() {
    wp_deregister_script( 'wp-embed' );
}

if ( false AND ! is_user_logged_in() ) {
    add_action( 'elementor/frontend/after_enqueue_scripts', 'fb_deregister_scripts');
    function fb_deregister_scripts() {
     
       // Dequeue and deregister elementor-frontend
       wp_deregister_script( 'elementor-frontend' );
       wp_dequeue_script( 'elementor-frontend' );
    }
}

add_action( 'after_setup_theme', function() {
	add_theme_support( 'woocommerce' );
    // Enabling WooCommerce product gallery features (are off by default since WC 3.0.0).
    // zoom.
    add_theme_support( 'wc-product-gallery-zoom' );
    // lightbox.
    add_theme_support( 'wc-product-gallery-lightbox' );
    // swipe.
    add_theme_support( 'wc-product-gallery-slider' );    
    add_theme_support( 'post-thumbnails' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'title-tag' );
} );

// Remove all Woo Styles
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );



