<?php 
	/** @var array $module */
	// `half-width` is a hard 800x450 crop, so with "Contain" selected the edges
	// of the picture were already missing. Use the un-cropped size and let CSS
	// decide how much of it to show. Small originals have no such derivative, so
	// fall back to the full-size file.
	$image = $module['image'];
	$image_url = isset( $image['sizes']['uncropped'] ) ? $image['sizes']['uncropped'] : $image['url'];
?>
<section class="module call-to-action outer <?= $module['image_position']; ?>">
	<div class="inner">
		<div class="image <?=  $module['image_size']; ?>" style="background-image: url(<?= $image_url; ?>)"></div>		
		<div class="text-container <?= $module['background_colour']; ?>">
			<div class="text">
				<h3><?= $module['title']; ?></h3>	
				<?= $module['text']; ?>
				<p class="button-link outline<?php if($module['background_colour'] != 'default' && $module['background_colour'] != 'orange-yellow' && $module['background_colour'] != 'lime-green' ) : ?> white<?php endif; ?>"><a href="<?= $module['link']; ?>"><?= $module['link_text']; ?></a></p>
			</div>
		</div>
	</div>	
</section>