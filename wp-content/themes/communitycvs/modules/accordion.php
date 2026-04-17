<section class="module outer accordion <?= $module['background_colour']; ?>">
	<?php if($module['display_title']) : ?>
	<div class="inner title title-<?= $module['cols_type']; ?><?php if($module['centred_title']) : ?> centred-title<?php endif; ?>"><h2><?= $module['title']; ?></h2></div>
	<?php endif; ?>
	<?php $accIndex = 0; ?>
	<div class="inner accordion-columns">
		<div class="column">
			<?php foreach($module['accordion_left_column'] as $accItem) : $accIndex++; $contentId = 'accordion-content-' . $modN . '-' . $accIndex; ?>
			<div class="accordion-section">
				<h4><button type="button" class="accordion-toggle" aria-expanded="false" aria-controls="<?= $contentId; ?>"><?= $accItem['title']; ?></button></h4>
				<div class="text" id="<?= $contentId; ?>" hidden><?= $accItem['content']; ?></div>
			</div>
			<?php endforeach; ?>
		</div>
		<div class="column">
			<?php foreach($module['accordion_right_column'] as $accItem) : $accIndex++; $contentId = 'accordion-content-' . $modN . '-' . $accIndex; ?>
			<div class="accordion-section">
				<h4><button type="button" class="accordion-toggle" aria-expanded="false" aria-controls="<?= $contentId; ?>"><?= $accItem['title']; ?></button></h4>
				<div class="text" id="<?= $contentId; ?>" hidden><?= $accItem['content']; ?></div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
