<section class="module call-to-action outer <?= $module['image_position']; ?>">
	<div class="inner">
		<div class="image <?=  $module['image_size']; ?>" style="background-image: url(<?= $module['image']['sizes']['half-width']; ?>)"></div>		
		<div class="text-container <?= $module['background_colour']; ?>">
			<div class="text">
				<h3><?= $module['title']; ?></h3>	
				<?= $module['text']; ?>
				<p class="button-link outline<?php if($module['background_colour'] != 'orange-yellow' && $module['background_colour'] != 'lime-green' ) : ?> white<?php endif; ?>"><a href="<?= $module['link']; ?>"><?= $module['link_text']; ?></a></p>
			</div>
		</div>
	</div>	
</section>