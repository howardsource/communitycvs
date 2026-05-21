<?php
/**
 * Community CVS functions and definitions
 */

function communitycvs_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'carousel', 1920, 1080, true );
    add_image_size( 'half-width', 800, 450, true );
    add_image_size( 'half-width-full', 800, 99999999, false );
    add_image_size( 'two-col', 594, 446, true );
    
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
    $js_version = file_exists( get_template_directory() . '/js/app.js' ) ? filemtime( get_template_directory() . '/js/app.js' ) : '1.0.0';
    wp_enqueue_script( 'communitycvs-script', get_template_directory_uri() . '/js/app.js', array(), $js_version, true );

    if ( is_post_type_archive( 'news' ) ) {
        global $wp_query;
        wp_localize_script(
            'communitycvs-script',
            'communitycvsNewsArchive',
            array(
                'ajaxUrl'     => admin_url( 'admin-ajax.php' ),
                'nonce'       => wp_create_nonce( 'communitycvs_news_load_more' ),
                'currentPage' => max( 1, (int) get_query_var( 'paged' ) ),
                'maxPages'    => isset( $wp_query->max_num_pages ) ? (int) $wp_query->max_num_pages : 1,
            )
        );
    }
}
add_action( 'wp_enqueue_scripts', 'communitycvs_scripts' );

/**
 * ACF JSON Save Point
 */
add_filter('acf/settings/save_json', 'communitycvs_acf_json_save_point');
function communitycvs_acf_json_save_point( $path ) {
    // update path
    $path = get_template_directory() . '/acf-json';
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
    $paths[] = get_template_directory() . '/acf-json';
    if ( get_stylesheet_directory() !== get_template_directory() ) {
        $paths[] = get_stylesheet_directory() . '/acf-json';
    }
    return $paths;
}

function communitycvs_news_archive_posts_per_page( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( $query->is_post_type_archive( 'news' ) ) {
		$query->set( 'posts_per_page', 9 );
	}
}
add_action( 'pre_get_posts', 'communitycvs_news_archive_posts_per_page' );

function communitycvs_render_news_tile( $post_id = 0 ) {
    $post_id = $post_id ? (int) $post_id : get_the_ID();
    if ( ! $post_id ) {
        return;
    }

    $thumb = get_field( 'thumbnail', $post_id );
    $news_categories = get_the_terms( $post_id, 'news-category' );
    $news_category_label = ( ! is_wp_error( $news_categories ) && ! empty( $news_categories ) ) ? $news_categories[0]->name : '';
    $news_category_classes = '';
    $news_category_slugs = array();

    if ( ! is_wp_error( $news_categories ) && ! empty( $news_categories ) ) {
        foreach ( $news_categories as $news_category ) {
            $slug = sanitize_title( $news_category->slug );
            $news_category_classes .= ' ' . sanitize_html_class( $slug );
            $news_category_slugs[] = $slug;
        }
    }

    $tile_classes = 'event-tile news-tile' . $news_category_classes;
    $tile_data_categories = implode( ',', array_unique( $news_category_slugs ) );
    ?>
    <article class="<?php echo esc_attr( $tile_classes ); ?>" data-news-categories="<?php echo esc_attr( $tile_data_categories ); ?>">
        <?php if ( $thumb ) : ?>
            <div class="image">
                <img
                    src="<?php echo esc_url( $thumb['sizes']['half-width'] ); ?>"
                    width="<?php echo esc_attr( $thumb['sizes']['half-width-width'] ); ?>"
                    height="<?php echo esc_attr( $thumb['sizes']['half-width-height'] ); ?>"
                    alt="<?php echo esc_attr( $thumb['alt'] ); ?>"
                />
            </div>
        <?php endif; ?>
        <div class="category-band"><?php echo esc_html( $news_category_label ); ?></div>
        <div class="description">
            <div class="date"><?php echo esc_html( date_i18n( 'l jS F y', strtotime( get_the_date( '', $post_id ) ) ) ); ?></div>
            <h4><?php echo esc_html( get_the_title( $post_id ) ); ?></h4>
            <div class="link-button"><a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">Read More</a></div>
        </div>
    </article>
    <?php
}

function communitycvs_ajax_load_more_news() {
    check_ajax_referer( 'communitycvs_news_load_more', 'nonce' );

    $paged = isset( $_POST['page'] ) ? max( 1, (int) $_POST['page'] ) : 1;

    $news_query = new WP_Query(
        array(
            'post_type'      => 'news',
            'posts_per_page' => 9,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
            'paged'          => $paged,
        )
    );

    ob_start();
    if ( $news_query->have_posts() ) {
        while ( $news_query->have_posts() ) {
            $news_query->the_post();
            communitycvs_render_news_tile( get_the_ID() );
        }
    }
    $html = ob_get_clean();
    wp_reset_postdata();

    wp_send_json_success(
        array(
            'html'      => $html,
            'nextPage'  => $paged + 1,
            'hasMore'   => $paged < (int) $news_query->max_num_pages,
            'maxPages'  => (int) $news_query->max_num_pages,
        )
    );
}
add_action( 'wp_ajax_communitycvs_load_more_news', 'communitycvs_ajax_load_more_news' );
add_action( 'wp_ajax_nopriv_communitycvs_load_more_news', 'communitycvs_ajax_load_more_news' );
