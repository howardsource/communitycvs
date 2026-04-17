
<?php
$cardType = isset($module['card_type']) ? $module['card_type'] : 'image';
$tileAccentMap = array(
	'orange-yellow' => '#F9B233',
	'teal-blue' => '#17709A',
	'olive-green' => '#838132',
	'dark-blue' => '#29317B',
	'teal-green' => '#10726B',
	'purple' => '#972685',
	'lime-green' => '#91BC3D',
);
?>
<section class="outer module tiles <?= $module['background_colour']; ?> <?= $module['tile_group_type']; ?> card-type-<?= $cardType; ?>">
	<?php if($module['display_title']) : ?>
	<div class="inner module-title"><h2><?= $module['title']; ?></h2></div>
	<?php endif; ?>
	<div class="inner tile-group">
		<?php foreach($module['tiles'] as $tile) : ?>
		<?php
		$tileColour = isset($tile['tile_colour']) ? $tile['tile_colour'] : '';
		$tileAccent = $tileColour && isset($tileAccentMap[$tileColour]) ? $tileAccentMap[$tileColour] : '';
		?>
		<div class="tile <?= $tileColour; ?>"<?php if($tileAccent) : ?> style="--tile-accent: <?= $tileAccent; ?>"<?php endif; ?>>
			<?php if($cardType=='image' && !empty($tile['image'])) : ?>
			<div class="image-outer"><div class="image" style="background-image: url(<?= $tile['image']['sizes']['half-width']; ?>)"></div></div>
			<?php endif; ?>
			<h4><a href="<?= $tile['link']; ?>"><?= $tile['title']; ?></a></h4>
			<?php if($tile['excerpt']!='') : ?><h5><?= $tile['excerpt']; ?></h5><?php endif; ?>
		</div>
		<?php endforeach; ?>
	</div>
	<?php if($module['more_link']!='') : ?>
		<div class="more-link inner"><a class="link-button" href="<?= $module['more_link']; ?>"><?= $module['more_link_text']; ?></a></div>
	<?php endif; ?>
</section>
