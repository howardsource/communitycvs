<section class="outer module illustrated-link-tiles">
	<div class="inner">
		<?php if ( ! empty( $module['title'] ) ) : ?>
		<div class="title">
			<h3><?= esc_html( $module['title'] ); ?></h3>
		</div>
		<?php endif; ?>

		<?php if ( ! empty( $module['tiles'] ) && is_array( $module['tiles'] ) ) : ?>
		<div class="tile-grid">
			<?php foreach ( $module['tiles'] as $tile ) : ?>
			<?php
			$tile_link = ! empty( $tile['link'] ) ? $tile['link'] : '';
			$tile_link_id = $tile_link ? url_to_postid( $tile_link ) : 0;
			$tile_link_text = $tile_link_id ? get_the_title( $tile_link_id ) : 'View';
			?>
			<div class="tile">
				<?php if ( ! empty( $tile['illustration_image']['url'] ) ) : ?>
				<div class="image-outer">
					<img src="<?= esc_url( $tile['illustration_image']['url'] ); ?>" alt="<?= esc_attr( $tile['illustration_image']['alt'] ?? '' ); ?>" />
				</div>
				<?php endif; ?>

				<?php if ( $tile_link ) : ?>
				<div class="link-button">
					<a href="<?= esc_url( $tile_link ); ?>"><?= esc_html( $tile_link_text ); ?></a>
				</div>
				<?php endif; ?>
			</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>
</section>
