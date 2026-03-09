<section class="outer module stacked-title-and-text pink">
	<?php if($module['display_title']) : ?>
	<div class="inner module-title"><h3><?= $module['title']; ?></h3></div>
	<?php endif; ?>
	<div class="inner stacked-blocks">
		<?php foreach($module['stacked_blocks'] as $block) : ?>
		<div class="block">
			<h4><?= $block['title']; ?></h4>
			<div class="text"><?= $block['text']; ?></div>
		</div>
		<?php endforeach; ?>
	</div>
</section>