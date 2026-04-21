<?php get_header(); ?>
<?php if ( is_front_page() ) : ?>
<?php get_template_part( 'home-carousel' ); ?>
<?php endif; ?>
<?php if (is_page() && !is_front_page()) : ?>
<?php
$banner_colour = get_field('banner_colour');
$banner_image = get_field('banner_image');
$banner_contain_image = get_field('contain_image');
$banner_class = 'title-banner outer';
if ($banner_colour) $banner_class .= ' ' . esc_attr($banner_colour);
if ($banner_image) $banner_class .= ' has-image';
if (!$banner_image) $banner_class .= ' no-image';
if ($banner_image && $banner_contain_image) $banner_class .= ' contain-image';
?>
<section class="<?php echo $banner_class; ?>">
	<div class="band">
		<div class="inner">
			<h2><?php the_title(); ?></h2>
			<?php if ($banner_image) : ?>
			<div class="banner-image" style="background-image: url(<?php echo esc_url($banner_image['sizes']['carousel']); ?>)"></div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php if ( function_exists('yoast_breadcrumb') ) {
	yoast_breadcrumb( '<div id="breadcrumbs" class="outer"><div class="yoast-breadcrumbs inner">','</div></div>' );
} ?>

<?php endif; ?>
<?php get_template_part('modules'); ?>
<?php get_footer(); ?>
