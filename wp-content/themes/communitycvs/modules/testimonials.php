<section id="testimonial-<?= $modN; ?>" class="module outer testimonials swiper">
	<div class="swiper-wrapper">
	<?php foreach($module['testimonials'] as $slide) : ?>
	<div class="swiper-slide">
		<div class="image" style="background-image: url(<?php echo $slide['image']['sizes']['carousel']; ?>)"></div>
		<?php if($slide['colour_select']!='') : ?>
		<div class="text" style="background-color: <?= $slide['colour_select']; ?>">	
		<?php else : ?>
		<div class="text <?= $slide['colour']; ?>">
		<?php endif; ?>
			<div class="quote"><?= $slide['text']; ?></div>
			<div class="attr"><?= $slide['name']; ?></div>
		</div>
	</div>
	<?php endforeach; ?>
	</div>
</section>
<script>
	var swiper = new Swiper('#testimonial-<?= $modN; ?>', {
		slidesPerView: 1,
		loop: true,
		speed: 700,
		effect: 'fade',
		autoplay: {
			delay: 3000,
		}
	});
</script>