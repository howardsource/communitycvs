
<?php
$cardType = isset($module['card_type']) ? $module['card_type'] : 'image';
$cardLayout = isset($module['card_layout']) ? $module['card_layout'] : '3-col';
$tileImageSize = ($cardLayout === '2-col') ? 'two-col' : 'half-width';
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
<section class="outer module tiles <?= $module['background_colour']; ?> card-layout-<?= $cardLayout; ?> <?= $module['tile_group_type']; ?> card-type-<?= $cardType; ?>">
	<?php if($module['display_title']) : ?>
	<div class="inner module-title"><h2><?= $module['title']; ?></h2></div>
	<?php endif; ?>
	<div class="inner tile-group">
		<?php foreach($module['tiles'] as $tile) : ?>
		<?php
		$tileColour = isset($tile['tile_colour']) ? $tile['tile_colour'] : '';
		$tileAccent = $tileColour && isset($tileAccentMap[$tileColour]) ? $tileAccentMap[$tileColour] : '';
		$tileImageUrl = '';
		if (!empty($tile['image']['sizes'][$tileImageSize])) {
			$tileImageUrl = $tile['image']['sizes'][$tileImageSize];
		} elseif (!empty($tile['image']['sizes']['half-width'])) {
			$tileImageUrl = $tile['image']['sizes']['half-width'];
		} elseif (!empty($tile['image']['url'])) {
			$tileImageUrl = $tile['image']['url'];
		}
		?>
		<div class="tile <?= $tileColour; ?>"<?php if($tileAccent) : ?> style="--tile-accent: <?= $tileAccent; ?>"<?php endif; ?>>
			<?php if($cardType=='image' && $tileImageUrl !== '') : ?>
			<div class="image-outer"><div class="image" style="background-image: url(<?= esc_url($tileImageUrl); ?>)"></div></div>
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
