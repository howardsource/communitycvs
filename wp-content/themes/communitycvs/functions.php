<?php
/**
 * Community CVS functions and definitions
 */

function communitycvs_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    
    // Register Navigation Menus
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'communitycvs' ),
    ) );
}
add_action( 'after_setup_theme', 'communitycvs_setup' );

/**
 * Enqueue scripts and styles.
 */
function communitycvs_scripts() {
    // Enqueue the main stylesheet
    wp_enqueue_style( 'communitycvs-style', get_stylesheet_uri() );
    
    // Enqueue compiled CSS from SCSS
    wp_enqueue_style( 'communitycvs-main', get_template_directory_uri() . '/css/main.css', array(), '1.0.0' );

    // Enqueue script
    wp_enqueue_script( 'communitycvs-script', get_template_directory_uri() . '/js/app.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'communitycvs_scripts' );
