<div class="module gallery outer <?= $module['background_colour']; ?>">
	<div class="inner">
		<div id="gallery-<?= $modN; ?>" class="swiper">
			<div class="swiper-wrapper">
			<?php foreach($module['gallery'] as $image) : ?>
				<div class="swiper-slide">
					<img src="<?= $image['sizes']['carousel']; ?>" width="<?= $image['sizes']['carousel-width']; ?>" height="<?= $image['sizes']['carousel-height']; ?>" alt="<?= $image['alt']; ?>" />
					<?php if($image['caption']!='') : ?>
						<div class="caption"><?= $image['caption']; ?></div>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
			</div>
			<div class="swiper-button-prev"></div><div class="swiper-button-next"></div>
			<div class="swiper-pagination"></div>
		</div>
		
	</div>
</div>
<script>
	var swiper = new Swiper('#gallery-<?= $modN; ?>', {
		slidesPerView: 1,
		loop: false,
		speed: 700,
		
		  navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		  },
		pagination: {
			el: '.swiper-pagination',
			type: 'custom',
			renderCustom: function (swiper, current, total) {
			  return `${current} / ${total}`;
			}
		  },
		autoplay: {
			delay: 5000,
		}
	});
</script>