<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<?php if ( function_exists( 'yoast_breadcrumb' ) ) : ?>
<div id="breadcrumbs" class="outer">
	<div class="yoast-breadcrumbs inner"><?php yoast_breadcrumb(); ?></div>
</div>
<?php endif; ?>

<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		$news_content = get_field( 'content' );
			$headline_image = get_field( 'headline_image' );
		$news_title   = get_the_title();
		$news_date    = get_the_date( 'l jS F' );
		$news_url     = get_permalink();
		$share_title  = get_the_title();
		$previous_post = get_previous_post();
		$next_post     = get_next_post();
		$modules       = get_field( 'modules' );
		$facebook_share_url = 'https://www.facebook.com/sharer/sharer.php?u=' . rawurlencode( $news_url );
		$linkedin_share_url = 'https://www.linkedin.com/shareArticle?mini=true&url=' . rawurlencode( $news_url ) . '&title=' . rawurlencode( $share_title );
		$x_share_url        = 'https://twitter.com/intent/tweet?url=' . rawurlencode( $news_url ) . '&text=' . rawurlencode( $share_title );
		?>
<div id="modules">
	<section class="outer module news-content pale-blue">
		<div class="inner">
			<header class="news-header">
				<h1><?php echo esc_html( $news_title ); ?></h1>
				<div class="news-date"><?php echo esc_html( $news_date ); ?></div>
			</header>
			<?php if ( ! empty( $headline_image ) && ! empty( $headline_image['url'] ) ) : ?>
			<div class="news-headline-image">
				<img
					src="<?php echo esc_url( $headline_image['url'] ); ?>"
					alt="<?php echo esc_attr( $headline_image['alt'] ?? '' ); ?>"
					loading="lazy"
				/>
			</div>
			<?php endif; ?>
			<?php if ( ! empty( $news_content ) ) : ?>
			<?php echo apply_filters( 'the_content', $news_content ); ?>
			<?php endif; ?>
			<div class="news-share">
				<ul class="social-links">
					<li class="social-facebook"><a href="<?php echo esc_url( $facebook_share_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on Facebook">FB</a></li>
					<li class="social-linkedin"><a href="<?php echo esc_url( $linkedin_share_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on LinkedIn">LI</a></li>
					<li class="social-x"><a href="<?php echo esc_url( $x_share_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on X">X</a></li>
				</ul>
				<div class="news-share-label">Share Story</div>
			</div>
			<nav class="news-post-nav" aria-label="News post navigation">
				<?php if ( $previous_post ) : ?>
				<div class="link-button nav-button nav-prev">
					<a href="<?php echo esc_url( get_permalink( $previous_post->ID ) ); ?>">previous post</a>
				</div>
				<?php else : ?>
				<div class="link-button nav-button nav-prev is-disabled">
					<a aria-disabled="true">previous post</a>
				</div>
				<?php endif; ?>
				<?php if ( $next_post ) : ?>
				<div class="link-button nav-button nav-next">
					<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">next post</a>
				</div>
				<?php else : ?>
				<div class="link-button nav-button nav-next is-disabled">
					<a aria-disabled="true">next post</a>
				</div>
				<?php endif; ?>
			</nav>
		</div>
	</section>
	<?php
	$modN      = 1;
	$carouselN = 1;
	if ( $modules ) :
		foreach ( $modules as $module ) :
			include locate_template( 'modules/' . $module['acf_fc_layout'] . '.php' );
			$modN++;
			if ( 'carousel' === $module['acf_fc_layout'] || 'panel_slider' === $module['acf_fc_layout'] || 'latest_news' === $module['acf_fc_layout'] ) :
				$carouselN++;
			endif;
		endforeach;
	endif;
	?>
</div>
		<?php
	endwhile;
endif;
?>

<?php get_footer(); ?>
