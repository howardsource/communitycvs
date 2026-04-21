<?php
if ( ! function_exists( 'get_field' ) ) {
    return;
}

$slides = get_field( 'home_carousel_slides' );
if ( empty( $slides ) || ! is_array( $slides ) ) {
    return;
}
?>

<section class="home-carousel outer" aria-label="Featured">
    <div class="band">
        <div class="home-carousel-inner">
            <div class="home-carousel-wrap" data-home-carousel>
                <div class="home-carousel-track" role="group">
                    <?php foreach ( $slides as $index => $slide ) : ?>
                        <?php
                        $image = $slide['image'] ?? null;
                        $heading = $slide['heading'] ?? '';
                        $text = $slide['text'] ?? '';
                        $link = $slide['link'] ?? null;
                        $background_colour = trim( (string) ( $slide['background_colour'] ?? '' ) );
                        $slide_inner_classes = 'home-carousel-slide-inner';
                        if ( $background_colour !== '' ) {
                            $slide_inner_classes .= ' ' . sanitize_html_class( $background_colour );
                        }

                        $image_url = '';
                        if ( is_array( $image ) ) {
                            $image_url = $image['sizes']['carousel'] ?? ( $image['url'] ?? '' );
                        }
                        ?>
                        <article class="home-carousel-slide" aria-roledescription="slide" aria-label="<?php echo esc_attr( (string) ( $index + 1 ) ); ?>">
                            <div class="<?php echo esc_attr( $slide_inner_classes ); ?>">
                                <div class="home-carousel-layout">
                                    <div class="home-carousel-image" style="<?php echo $image_url ? 'background-image: url(' . esc_url( $image_url ) . ');' : ''; ?>"></div>
                                    <div class="home-carousel-content">
                                        <?php if ( $heading ) : ?>
                                            <h2><?php echo esc_html( $heading ); ?></h2>
                                        <?php endif; ?>
                                        <?php if ( $text ) : ?>
                                            <p><?php echo esc_html( $text ); ?></p>
                                        <?php endif; ?>
                                        <?php if ( is_array( $link ) && ! empty( $link['url'] ) ) : ?>
                                            <a class="home-carousel-button" href="<?php echo esc_url( $link['url'] ); ?>"<?php echo ! empty( $link['target'] ) ? ' target="' . esc_attr( $link['target'] ) . '"' : ''; ?>>
                                                <?php echo esc_html( $link['title'] ?? 'Learn more' ); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

                <div class="home-carousel-controls">
                    <div class="home-carousel-dots" role="tablist" aria-label="Carousel pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section>
