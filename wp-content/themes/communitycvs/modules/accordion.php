<section class="module outer accordion <?= $module['background_colour']; ?>">
	<?php if($module['display_title']) : ?>
	<div class="inner title title-<?= $module['cols_type']; ?><?php if($module['centred_title']) : ?> centred-title<?php endif; ?>"><h3><?= $module['title']; ?></h3></div>
	<?php endif; ?>
	<div class="inner accordion-columns">
		<div class="column">
			<?php foreach($module['accordion_left_column'] as $accItem) : ?>
			<div class="accordion-section">
				<h4><?= $accItem['title']; ?></h4>
				<div class="text"><?= $accItem['content']; ?></div>
			</div>
			<?php endforeach; ?>
		</div>
		<div class="column">
			<?php foreach($module['accordion_right_column'] as $accItem) : ?>
			<div class="accordion-section">
				<h4><?= $accItem['title']; ?></h4>
				<div class="text"><?= $accItem['content']; ?></div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>