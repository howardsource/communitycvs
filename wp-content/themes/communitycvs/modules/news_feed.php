<section id="event-lists-<?= $modN; ?>" class="outer module news-lists white">
	<div class="inner title">
		<h2>News</h2>
	</div>

	<div id="group-<?= $modN; ?>-0" class="inner news-list active">
		<?php
		$news_query = new WP_Query([
			'post_type'      => 'news',
			'posts_per_page' => 8,
			'post_status'    => 'publish',
		]);

		if ($news_query->have_posts()) :
			while ($news_query->have_posts()) : $news_query->the_post();
				$thumb = get_field('thumbnail');
		?>
			<div class="event-tile">
				<?php if ($thumb) : ?>
				<div class="image">
					<img 
						src="<?= esc_url($thumb['sizes']['event-tiles']); ?>" 
						width="<?= esc_attr($thumb['sizes']['event-tiles-width']); ?>" 
						height="<?= esc_attr($thumb['sizes']['event-tiles-height']); ?>" 
						alt="<?= esc_attr($thumb['alt']); ?>" 
					/>
				</div>
				<?php endif; ?>
				<div class="description">
					<div class="date"><?php the_field('date_caption'); ?></div>
					<h4><?php the_title(); ?></h4>
					<div class="link-button small"><a href="<?php the_permalink(); ?>">Read More</a></div>
				</div>
			</div>
		<?php
			endwhile;
			wp_reset_postdata();
		else :
			echo '<p>No news posts found.</p>';
		endif;
		?>
	</div>

	<div class="inner">
		<div class="read-more-text"><?= $module['read_more_text']; ?></div>
	</div>
</section>