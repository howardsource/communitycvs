<div class="outer module two-image-columns pink">
	<div class="inner">
		<div class="image">
			<img src="<?= $module['image_1']['sizes']['half-width']; ?>" alt="<?= $module['image_1']['alt']; ?>" />
			<?php if($module['image_1']['caption']!='') : ?>
			<div class="caption"><?= $module['image_1']['caption']; ?></div>
			<?php endif; ?>
		</div>
		<div class="image">
			<img src="<?= $module['image_2']['sizes']['half-width']; ?>" alt="<?= $module['image_2']['alt']; ?>" />
			<?php if($module['image_2']['caption']!='') : ?>
			<div class="caption"><?= $module['image_2']['caption']; ?></div>
			<?php endif; ?>
		</div>
	</div>
</div>