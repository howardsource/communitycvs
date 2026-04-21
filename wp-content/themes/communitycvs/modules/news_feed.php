<section id="event-lists-<?= $modN; ?>" class="outer module news-lists white">
	<div class="inner title">
		<h2>Our Latest News</h2>
	</div>

	<div id="group-<?= $modN; ?>-0" class="inner news-list active">
		<?php
		$news_query = new WP_Query([
			'post_type'      => 'news',
			'posts_per_page' => 3,
			'post_status'    => 'publish',
			'orderby'        => 'date',
			'order'          => 'DESC',
		]);

		if ($news_query->have_posts()) :
			while ($news_query->have_posts()) : $news_query->the_post();
				$thumb = get_field('thumbnail');
				$news_categories = get_the_terms(get_the_ID(), 'news-category');
				$news_category_label = (!is_wp_error($news_categories) && !empty($news_categories))
					? $news_categories[0]->name
					: '';
				$news_category_classes = '';
				if (!is_wp_error($news_categories) && !empty($news_categories)) {
					foreach ($news_categories as $news_category) {
						$news_category_classes .= sanitize_html_class($news_category->slug);
					}
				}
				$tile_classes = 'event-tile news-tile ' . $news_category_classes;
		?>
			<article class="<?= esc_attr($tile_classes); ?>">
				<?php if ($thumb) : ?>
				<div class="image">
					<img 
						src="<?= esc_url($thumb['sizes']['half-width']); ?>" 
						width="<?= esc_attr($thumb['sizes']['half-width-width']); ?>" 
						height="<?= esc_attr($thumb['sizes']['half-width-height']); ?>" 
						alt="<?= esc_attr($thumb['alt']); ?>" 
					/>
				</div>
				<?php endif; ?>
				<div class="category-band"><?= esc_html($news_category_label); ?></div>
				<div class="description">
					<div class="date"><?= date_i18n('l jS F y', strtotime(get_the_date())); ?></div>
					<h4><?php the_title(); ?></h4>
					<div class="link-button"><a href="<?php the_permalink(); ?>">Read More</a></div>
				</div>
			</article>
		<?php
			endwhile;
			wp_reset_postdata();
		else :
			echo '<p>No news posts found.</p>';
		endif;
		?>
	</div>

	<div class="inner">
		<div class="all-news-button link-button">
			<a href="<?= esc_url(get_post_type_archive_link('news')); ?>">ALL NEWS</a>
		</div>
	</div>
</section>
