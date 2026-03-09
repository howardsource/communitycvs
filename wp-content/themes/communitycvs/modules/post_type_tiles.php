<section class="module post-type outer <?php echo $module['post_type']; ?> <?php echo $module['background_colour']; ?>">
	<?php if($module['title']!='') : ?><div class="inner"><h2><?= $module['title']; ?></h2></div><?php endif; ?>
	<div id="post-carousel-<?= $modN; ?>" class="swiper">
		<div class="navigation-buttons"><div class="swiper-button-prev nav-button"></div><div class="swiper-button-next nav-button"></div></div>
		<div class="swiper-wrapper">
			<?php foreach($module[$module['post_type']] as $tile) : ?>
				<div class="swiper-slide">
					<div class="image-outer"><div class="image" style="background-image: url(<?php echo get_field('thumbnail', $tile->ID)['sizes']['half-width']; ?>)"></div></div>
					<div class="text"><h4><?php echo $tile->post_title; ?></h4>
					<div class="tags">
						<?php if(get_field('date__time_label', $tile->ID)) : ?>
						<div class="date"><?php echo get_field('date__time_label', $tile->ID); ?></div>
						<?php endif; ?>
						<?php
						if($module['post_type']=='events') :
						$terms = get_the_terms($tile->ID, 'event-categories');
						if ($terms && !is_wp_error($terms)) :
						?>
						<ul class="event-categories">
						<?php foreach ($terms as $term) :
						echo '<li class="small-button-link"><span>' . esc_html($term->name) . '</span></li>';
						endforeach; 
						?>
						</ul>
						<?php endif; endif; ?>
						<?php if(get_field('venue_details', $tile->ID)) : ?>
						<div class="venue"><span><?= get_field('venue_details', $tile->ID); ?></span></div>
						<?php endif; ?>
					</div>
					
					<?php if(get_field('excerpt', $tile->ID)!='') : ?><h5><?= get_field('excerpt', $tile->ID); ?></h5><?php endif; ?>
					<p class="small-button-link"><a href="<?php echo get_permalink( $tile->ID); ?>">Find out more</a></p></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php if($module['post_type']=='events') : ?>
	<div class="inner view-all"><p class="large-button-link"><a href="<?php echo site_url( 'whats-on'); ?>">View all What's On</a></p></div>
	<?php endif; ?>
</section>

<script>
	var swiper = new Swiper('#post-carousel-<?= $modN; ?>', {
		slidesPerView: 1,
		loop: true,
		spaceBetween: 66,
		speed: 700,
		
		  navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		  },
		pagination: {
			clickable: true,
			el: '.swiper-pagination',
			type: 'bullets',
		  },
		autoplay: {
			delay: 5000,
		}
	});
</script>