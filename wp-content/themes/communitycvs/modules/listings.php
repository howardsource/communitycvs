<section class="module outer listings">
	<?php if($module['display_title']) : ?>
	<div class="inner title title-<?= $module['cols_type']; ?><?php if($module['centred_title']) : ?> centred-title<?php endif; ?>"><h3><?= $module['title']; ?></h3></div>
	<?php endif; ?>
	<div class="inner listings-columns">
		<ul>
		<?php foreach($module['listings'] as $listItem) : ?>
			<li><a href="<?= $listItem['link']; ?>"><?= $listItem['title']; ?></a></li>
		<?php endforeach; ?>
		</ul>
	</div>
</section>