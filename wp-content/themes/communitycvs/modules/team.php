<?php $teamIndex = 0; ?>
<section class="outer module team pink">
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

				<div class="contact"><?=  $tile['business_team']; ?><br /><a href="mailto:<?= $tile['email']; ?>">Email <?= $tile['name']; ?></a></div>
				<div class="bio" id="<?= $bioId; ?>" hidden><?= $tile['bio']; ?></div>
				
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</section>
