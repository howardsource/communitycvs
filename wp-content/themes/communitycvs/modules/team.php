<?php
$teamIndex = 0;
if (!isset($module) || empty($module['team']) || !is_array($module['team'])) {
	return;
}
?>
<section class="outer module team pink">
	<?php if (!empty($module['team_title'])) : ?>
	<div class="inner team-title"><h3><?= esc_html($module['team_title']); ?></h3></div>
	<?php endif; ?>
	<div class="inner team-group">
		<?php foreach($module['team'] as $tile) : ?>
		<?php $teamIndex++; $bioId = 'team-bio-' . $modN . '-' . $teamIndex; ?>
		<div class="team-member reveal" role="button" tabindex="0" aria-expanded="false" aria-controls="<?= $bioId; ?>">
			<?php if (!empty($tile['thumbnail']['sizes']['half-width'])) : ?>
			<div class="image-outer"><div class="image" style="background-image: url(<?= $tile['thumbnail']['sizes']['half-width']; ?>)"></div></div>
			<?php endif; ?>
			<div class="text-outer">
				<h4><?= $tile['name']; ?></h4>
				<h5><?= $tile['role']; ?></h5>

				<div class="contact">
					<?php if (!empty($tile['business_team'])) : ?>
					<?= $tile['business_team']; ?><?php if (!empty($tile['telephone']) || !empty($tile['email'])) : ?><br /><?php endif; ?>
					<?php endif; ?>
					<?php if (!empty($tile['telephone'])) : ?>
					<?php
					$telephoneRaw = (string) $tile['telephone'];
					$telephoneHref = preg_replace('/[^0-9+]/', '', $telephoneRaw);
					?>
					Telephone <a href="tel:<?= esc_attr($telephoneHref); ?>"><?= esc_html($telephoneRaw); ?></a><?php if (!empty($tile['email'])) : ?><br /><?php endif; ?>
					<?php endif; ?>
					<?php if (!empty($tile['email'])) : ?>
					<a href="mailto:<?= esc_attr($tile['email']); ?>">Email <?= $tile['name']; ?></a>
					<?php endif; ?>
				</div>
				<div class="bio" id="<?= $bioId; ?>" hidden><?= $tile['bio']; ?></div>
				
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</section>
