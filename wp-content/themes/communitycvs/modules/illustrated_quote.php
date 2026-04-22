<section class="outer module illustrated-quote">
	<div class="inner">
		<div class="illustrated-quote-layout">
			<div class="illustrated-quote-image left-image">
				<?php if ( ! empty( $module['left_image']['url'] ) ) : ?>
				<img src="<?= esc_url( $module['left_image']['url'] ); ?>" alt="<?= esc_attr( $module['left_image']['alt'] ?? '' ); ?>" />
				<?php endif; ?>
			</div>
			<div class="illustrated-quote-text">
				<?php if ( ! empty( $module['quote_paragraph'] ) ) : ?>
				<p><?= esc_html( $module['quote_paragraph'] ); ?></p>
				<?php endif; ?>
			</div>
			<div class="illustrated-quote-image right-image">
				<?php if ( ! empty( $module['right_image']['url'] ) ) : ?>
				<img src="<?= esc_url( $module['right_image']['url'] ); ?>" alt="<?= esc_attr( $module['right_image']['alt'] ?? '' ); ?>" />
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
