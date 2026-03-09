
<section class="outer module tiles <?= $module['background_colour']; ?> <?= $module['tile_group_type']; ?>">
	<?php if($module['display_title']) : ?>
	<div class="inner module-title"><h3><?= $module['title']; ?></h3></div>
	<?php endif; ?>
	<div class="inner tile-group">
		<?php foreach($module['tiles'] as $tile) : ?>
		<div class="tile">
			<div class="image-outer"><div class="image" style="background-image: url(<?= $tile['image']['sizes']['tiles']; ?>")"></div></div>
			<h4><a href="<?= $tile['link']; ?>"><?= $tile['title']; ?></a></h4>
			<?php if($tile['excerpt']!='') : ?><h5><?= $tile['excerpt']; ?></h5><?php endif; ?>
		</div>
		<?php endforeach; ?>
	</div>
	<?php if($module['more_link']!='') : ?>
		<div class="more-link inner"><a class="link-button" href="<?= $module['more_link']; ?>"><?= $module['more_link_text']; ?></a></div>
	<?php endif; ?>
</section>