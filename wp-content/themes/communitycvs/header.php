<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header outer">
    <div class="inner">
        <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
        <nav class="site-nav">
            <!-- Top menu section: quick links, social media, search -->
            <div class="nav-top">
                <ul class="quick-links">
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-home">Home</a></li>
					<?php $quickLinks = get_field('quick_links', 'options'); ?>
					<?php if ($quickLinks) : ?>
                    <?php foreach($quickLinks as $link) : ?>
					<?php
					$linkTitle = isset($link['title']) ? trim((string) $link['title']) : '';
					$isContactModalLink = strtolower($linkTitle) === 'contact us';
					?>
                    <li>
						<?php if ($isContactModalLink) : ?>
						<a
							href="#"
							class="js-contact-modal-open"
							data-contact-modal-open="true"
							aria-haspopup="dialog"
							aria-controls="contact-modal"
						><?php echo esc_html($linkTitle); ?></a>
						<?php else : ?>
						<a href="<?php echo esc_url($link['link']); ?>"><?php echo esc_html($linkTitle); ?></a>
						<?php endif; ?>
					</li>
                    <?php endforeach; ?>
					<?php endif; ?>
                </ul>
                <ul class="social-links">
                    <li class="social-facebook"><a href="#" aria-label="Facebook">FB</a></li>
                    <li class="social-instagram"><a href="#" aria-label="Instagram">IG</a></li>
					<li class="social-linkedin"><a href="#" aria-label="LinkedIn">LI</a></li>
					<li class="social-x"><a href="#" aria-label="X">X</a></li>
                </ul>
                <div class="contact-button">
					<a
						href="#"
						class="js-contact-modal-open"
						data-contact-modal-open="true"
						aria-haspopup="dialog"
						aria-controls="contact-modal"
					>Contact Us</a>
				</div>
            </div>

            <!-- Bottom menu section: main dropdown menus -->
            <div class="nav-bottom">
                <ul class="main-menu">
					<?php $mainMenu = get_field('main_menu', 'options'); ?>
					<?php if ($mainMenu) : ?>
                    <?php foreach($mainMenu as $link) : ?>
					<?php $submenuColumns = isset($link['submenu_columns']) ? $link['submenu_columns'] : array(); ?>
					<?php $submenuColumnCount = $submenuColumns ? count($submenuColumns) : 0; ?>
					<li class="<?php echo $submenuColumns ? 'menu-item-has-children has-megamenu' : ''; ?>">
                        <a href="<?php echo esc_url( $link['link'] ); ?>"><?php echo esc_html($link['title']); ?></a>
						<?php if ($submenuColumns) : ?>
                        <ul class="sub-menu megamenu" style="--megamenu-columns: <?php echo (int) $submenuColumnCount; ?>;">
							<?php foreach($submenuColumns as $column) : ?>
							<?php
							$columnAccentClass = '';
							if (!empty($column['column_accent'])) {
								$columnAccentClass = ' ' . sanitize_html_class($column['column_accent']);
							}
							?>
							<li class="submenu-column">
								<?php if (!empty($column['column_image'])) : ?>
								<div class="submenu-column-image<?php echo esc_attr($columnAccentClass); ?>" style="background-image: url(<?php echo esc_url($column['column_image']['sizes']['half-width']); ?>)"></div>
								<?php else : ?>
								<div class="submenu-column-accent-band<?php echo esc_attr($columnAccentClass); ?>"></div>
								<?php endif; ?>
								<?php if (!empty($column['title_link'])) : ?>
								<div class="submenu-column-title"><a href="<?php echo esc_url(get_permalink($column['title_link'])); ?>"><?php echo esc_html($column['column_title']); ?></a></div>
								<?php else : ?>
								<div class="submenu-column-title"><?php echo esc_html($column['column_title']); ?></div>
								<?php endif; ?>
								<?php if (!empty($column['column_links'])) : ?>
								<ul class="submenu-column-links">
									<?php foreach($column['column_links'] as $columnLink) : ?>
									<li>
										<a href="<?php echo esc_url(get_permalink($columnLink['link'])); ?>"><?php echo esc_html($columnLink['title']); ?></a>
									</li>
									<?php endforeach; ?>
								</ul>
								<?php endif; ?>
							</li>
							<?php endforeach; ?>
                        </ul>
						<?php endif; ?>
                    </li>
                    <?php endforeach; ?>
					<?php endif; ?>
                    
                </ul>
            </div>
        </nav>
    </div>
</header>
<div class="contact-modal" id="contact-modal" hidden>
	<div class="contact-modal__backdrop" data-contact-modal-close></div>
	<div class="contact-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="contact-modal-title">
		<button type="button" class="contact-modal__close" aria-label="Close contact modal" data-contact-modal-close>&times;</button>
		<div class="contact-modal__content">
			<h3 id="contact-modal-title">Get in Touch</h3>
			<p>Email us<br><a href="mailto:info@communitycvs.org.uk">info@communitycvs.org.uk</a></p>
			<p>Telephone<br><strong>01254 583957</strong></p>
			<p>Visit Us:<br>[address to be added by me!]</p>
		</div>
	</div>
</div>
<main id="main" class="site-main">
