<?php 
	/** @var array $module */
	$galleryImages = isset($module['gallery']) && is_array($module['gallery']) ? $module['gallery'] : array();
?>
<div class="module gallery outer <?= $module['background_colour']; ?>">
	<div class="inner">
		<div class="gallery-slider" id="gallery-<?= $modN; ?>" data-autoplay="5000">
			<div class="gallery-slider-viewport">
				<div class="gallery-slider-track">
					<?php foreach($galleryImages as $image) : ?>
					<figure class="gallery-slide">
						<?php
							// `carousel` is a hard 16:9 crop, which chops portrait
							// shots, so use the un-cropped size instead. Images
							// uploaded before that size existed fall back to the
							// original file, which is still un-cropped.
							echo wp_get_attachment_image( $image['ID'], 'uncropped', false, array( 'alt' => $image['alt'] ) );
						?>
						<?php if($image['caption']!='') : ?>
							<figcaption class="caption"><?= $image['caption']; ?></figcaption>
						<?php endif; ?>
					</figure>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="gallery-slider-controls">
				<span class="gallery-slider-counter"></span>
				<div class="gallery-slider-nav">
					<button type="button" class="gallery-nav gallery-prev" aria-label="Previous image" aria-controls="gallery-<?= $modN; ?>">&#8249;</button>
					<button type="button" class="gallery-nav gallery-next" aria-label="Next image" aria-controls="gallery-<?= $modN; ?>">&#8250;</button>
				</div>
			</div>
		</div>
	</div>
</div>
