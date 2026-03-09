<section id="event-lists-<?= $modN; ?>" class="outer module event-lists white">
	<div class="inner title">
		<h2><?= $module['title']; ?></h2>
		<div class="subtitle"><?= $module['subtitle']; ?></div>
	</div>
	<div class="inner event-list-filter">
		<ul>
			<?php $n=0; foreach($module['event_groups'] as $filter) : ?>
			<li data-filter="<?= $modN; ?>-<?= $n; ?>" <?php if($n==0) : ?> class="active"<?php endif; ?>><?= $filter['group_title']; ?></li>
			<?php $n++; endforeach; ?>	
		</ul>
	</div>
<?php $n=0; foreach($module['event_groups'] as $group) : ?>
	<div id="group-<?= $modN; ?>-<?= $n; ?>"  class="inner event-list <?= $n >= 1 ? ' hidden' : ' active'; ?>">
		<?php foreach($group['events'] as $tile) : ?>
		<div class="event-tile">
			<div class="image">
				<img src="<?php echo get_field('thumbnail', $tile)['sizes']['event-tiles']; ?>" width="<?php echo get_field('thumbnail', $tile)['sizes']['event-tiles-width']; ?>" height="<?php echo get_field('thumbnail', $tile)['sizes']['event-tiles-height']; ?>" alt="<?php echo get_field('thumbnail', $tile)['alt']; ?>" />
			</div>
			<div class="description">
				<div class="date"><?php the_field('date_caption', $tile); ?></div>
				<h4><?php the_field('event_title', $tile); ?></h4>
				<div class="link-button small"><a href="<?php echo get_permalink($tile); ?>">Buy Tickets</a></div>
			</div>
		</div>		
		<?php endforeach; ?>
	</div>
<?php $n++; endforeach; ?>
	<div class="inner">
		<div class="read-more-text"><?= $module['read_more_text']; ?></div>
	</div>
</section>