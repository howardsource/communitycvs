<section class="outer module team pink">
	<div class="inner team-group">
		<?php foreach($module['team'] as $tile) : ?>
		<div class="team-member reveal">
			<div class="image-outer"><div class="image" style="background-image: url(<?= $tile['thumbnail']['sizes']['tiles']; ?>")"></div></div>
			<div class="text-outer">
				<h4><?= $tile['name']; ?></h4>
				<h5><?= $tile['role']; ?></h5>
				<div class="bio"><?= $tile['bio']; ?></div>
				<div class="contact"><?= $tile['mobile']; ?><span class="separator"> . </span><a href="mailto:<?= $tile['email']; ?>"><?= $tile['email']; ?></a></div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</section>