<section class="outer module testimonial-columns">
	<?php if($module['title']!=='') : ?>
	<div class="inner module-title"><h3><?= $module['title']; ?></h3></div>
	<?php endif; ?>
	<div class="inner">
		<?php foreach($module['testimonials'] as $testimonial) : ?>
			<div class="testimonial <?= $testimonial['type'] ?>">
				<div class="columns">
					<div class="column <?php if($testimonial['type']=='single-column') : ?>circle-col<?php endif; ?>">
						<div class="title"><h4><?= $testimonial['title']; ?></h4></div>
						<?= $testimonial['column_1']; ?>
						<?php if($testimonial['type']=='single-column') : ?>
							<div class="attr"><?= $testimonial['attribution']; ?></div>
							<div class="role"><?= $testimonial['job_title']; ?></div>
						<?php endif; ?>
					</div>
					<?php if($testimonial['type']=='two-column') : ?>
					<div class="column circle-col">
						<?= $testimonial['column_2']; ?>
						<div class="attr"><?= $testimonial['attribution']; ?></div>
						<div class="role"><?= $testimonial['job_title']; ?></div>
					</div>	
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>