<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<section class="title-banner outer dark-blue has-image contain-image news-archive-banner">
	<div class="band">
		<div class="inner">
			<h2><?php post_type_archive_title(); ?></h2>
			<div class="banner-image" style="background-image: url(<?php echo esc_url( get_template_directory_uri() . '/images/news-archive-banner.png' ); ?>)"></div>
		</div>
	</div>
</section>

<?php if ( function_exists( 'yoast_breadcrumb' ) ) : ?>
<div id="breadcrumbs" class="outer">
	<div class="yoast-breadcrumbs inner"><?php yoast_breadcrumb(); ?></div>
</div>
<?php endif; ?>

<div id="modules">
	<section class="outer module news-lists pale-blue">
		<div class="inner title">
			<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.</p>
		</div>
		<?php $news_filter_terms = get_terms( array( 'taxonomy' => 'news-category', 'hide_empty' => true ) ); ?>
		<div class="inner news-filter">
			<label for="news-category-filter">Filter:</label>
			<select id="news-category-filter" name="news-category-filter">
				<option value="">All News</option>
				<?php if ( ! is_wp_error( $news_filter_terms ) && ! empty( $news_filter_terms ) ) : ?>
					<?php foreach ( $news_filter_terms as $news_filter_term ) : ?>
						<option value="<?php echo esc_attr( $news_filter_term->slug ); ?>"><?php echo esc_html( $news_filter_term->name ); ?></option>
					<?php endforeach; ?>
				<?php endif; ?>
			</select>
		</div>

		<div class="inner news-list active" data-news-grid>
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php communitycvs_render_news_tile( get_the_ID() ); ?>
				<?php endwhile; ?>
			<?php else : ?>
				<p>No news posts found.</p>
			<?php endif; ?>
		</div>

		<?php
		global $wp_query;
		$next_page = get_next_posts_page_link( $wp_query->max_num_pages );
		if ( $next_page ) :
		?>
		<div class="inner" data-news-archive data-next-page="<?php echo esc_attr( max( 2, (int) get_query_var( 'paged' ) + 1 ) ); ?>">
			<div class="all-news-button link-button">
				<a href="<?php echo esc_url( $next_page ); ?>" class="js-news-load-more">Load More</a>
			</div>
		</div>
		<?php endif; ?>
	</section>
	<?php get_template_part( 'modules/newsletter_signup' ); ?>
</div>

<?php
get_footer();
