<?php
get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
            <?php get_template_part('modules'); ?>
		</article>
		<?php
	endwhile;
else :
	echo '<p>No content found</p>';
endif;

get_footer();
