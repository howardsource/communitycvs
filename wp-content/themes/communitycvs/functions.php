<?php
/**
 * Community CVS functions and definitions
 */

function communitycvs_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'carousel', 1920, 1080, true );
    add_image_size( 'half-width', 800, 450, true );
    
    // Register Navigation Menus
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'communitycvs' ),
    ) );
}
add_action( 'after_setup_theme', 'communitycvs_setup' );

function communitycvs_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'carousel' => __( 'Carousel', 'communitycvs' ),
        'half-width' => __( 'Half Width', 'communitycvs' ),
    ) );
}
add_filter( 'image_size_names_choose', 'communitycvs_custom_image_sizes' );

/**
 * Enqueue scripts and styles.
 */
function communitycvs_scripts() {
    // Enqueue Google Fonts
    wp_enqueue_style( 'communitycvs-google-fonts', 'https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap', array(), null );

    // Enqueue the main stylesheet
    wp_enqueue_style( 'communitycvs-style', get_stylesheet_uri() );
    
    // Enqueue compiled CSS from SCSS
    $css_version = file_exists( get_template_directory() . '/css/main.css' ) ? filemtime( get_template_directory() . '/css/main.css' ) : '1.0.1';
    wp_enqueue_style( 'communitycvs-main', get_template_directory_uri() . '/css/main.css', array(), $css_version );

    // Enqueue script
    wp_enqueue_script( 'communitycvs-script', get_template_directory_uri() . '/js/app.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'communitycvs_scripts' );

/**
 * ACF JSON Save Point
 */
add_filter('acf/settings/save_json', 'communitycvs_acf_json_save_point');
function communitycvs_acf_json_save_point( $path ) {
    // update path
    $path = get_stylesheet_directory() . '/acf-json';
    return $path;
}

/**
 * ACF JSON Load Point
 */
add_filter('acf/settings/load_json', 'communitycvs_acf_json_load_point');
function communitycvs_acf_json_load_point( $paths ) {
    // remove original path (optional)
    unset($paths[0]);
    
    // append path
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
}
