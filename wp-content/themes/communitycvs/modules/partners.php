<?php 
	/** @var array $module */
?>
<section class="outer module partners">
	<?php if($module['show_title']) : ?>
	<div class="inner module-title">
        <h2><?= $module['title']; ?></h2>
    </div>
	<?php endif; ?>
    <div class="inner partner-tile-group">
        <?php foreach($module['partners'] as $partner) : ?>
        <a class="partner-tile" href="<?= esc_url( $partner['link_url'] ); ?>" target="_blank" rel="noopener noreferrer">
            <div class="partner-logo"><img src="<?= esc_url( $partner['partner_logo']['sizes']['partner-logo'] ); ?>" alt="<?= esc_attr( $partner['partner_name'] ); ?>"></div>
            <div class="partner-link"><span><?= esc_html( $partner['partner_name'] ); ?></span></div>
        </a>
        <?php endforeach; ?>
    </div>
</section>
