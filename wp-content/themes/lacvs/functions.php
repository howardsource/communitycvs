<?php
add_filter('acf/load_field/name=banner_colour', 'child_theme_colour_choices');
add_filter('acf/load_field/name=background_colour', 'child_theme_colour_choices');
add_filter('acf/load_field/name=tile_colour', 'child_theme_colour_choices');

function child_theme_colour_choices($field) {

    if (!is_child_theme()) {
        return $field;
    }

    // Fields that should keep the parent theme choices.
    $excluded_fields = [
        'field_69b03729f3197', // Columns background colour
    ];

    if (in_array($field['key'], $excluded_fields, true)) {
        return $field;
    }

    $field['choices'] = [
        'default'    => 'Default',
        'maroon'     => 'Maroon',
        'rose'       => 'Rose',
        'green'      => 'Green',
        'dark-green' => 'Dark Green',
        'yellow'     => 'Yellow',
        'lilac'      => 'Lilac',
    ];

    return $field;
}

function lacvs_enqueue_styles() {
    $style_version = file_exists( get_stylesheet_directory() . '/style.css' ) ? filemtime( get_stylesheet_directory() . '/style.css' ) : null;

    wp_enqueue_style(
        'lacvs-style',
        get_stylesheet_uri(),
        array( 'communitycvs-main' ),
        $style_version
    );

    $lacvs_css_path = get_stylesheet_directory() . '/css/lacvs.css';
    $lacvs_css_version = file_exists( $lacvs_css_path ) ? filemtime( $lacvs_css_path ) : null;
    wp_enqueue_style(
        'lacvs-skin',
        get_stylesheet_directory_uri() . '/css/lacvs.css',
        array( 'lacvs-style' ),
        $lacvs_css_version
    );
}
add_action( 'wp_enqueue_scripts', 'lacvs_enqueue_styles', 20 );
