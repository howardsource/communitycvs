</main>

<footer class="site-footer outer">
    <div class="inner">
        <div class="footer-logo-tab">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
        </div>
        <nav class="footer-nav" aria-label="Footer">
            <a
                class="footer-contact-button js-contact-modal-open"
                href="#"
                data-contact-modal-open="true"
                aria-haspopup="dialog"
                aria-controls="contact-modal"
            >Contact Us</a>
            <ul class="footer-menu">
                <li><a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>">About Us</a></li>
                <li><a href="<?php echo esc_url( home_url( '/grants/' ) ); ?>">Grants</a></li>
                <li><a href="<?php echo esc_url( home_url( '/networks/' ) ); ?>">Networks</a></li>
                <li><a href="<?php echo esc_url( home_url( '/training/' ) ); ?>">Training</a></li>
                <li><a href="<?php echo esc_url( home_url( '/events/' ) ); ?>">Events</a></li>
                <li><a href="<?php echo esc_url( home_url( '/volunteering/' ) ); ?>">Volunteering</a></li>
                <li><a href="<?php echo esc_url( home_url( '/jobs/' ) ); ?>">Jobs</a></li>
                <li><a href="<?php echo esc_url( home_url( '/news/' ) ); ?>">News</a></li>
            </ul>
        </nav>
        <div class="footer-bottom">
            <div class="footer-follow">
                <h4>Follow Us</h4>
                <ul class="footer-social">
                    <li><a class="footer-social-link facebook" href="https://www.facebook.com/Communitycvs" aria-label="Facebook">Facebook</a></li>
                    <li><a class="footer-social-link instagram" href="https://www.instagram.com/cvscommunity/" aria-label="Instagram">Instagram</a></li>
                    <li><a class="footer-social-link linkedin" href="https://www.linkedin.com/company/blackburn-with-darwen-cvs/" aria-label="LinkedIn">LinkedIn</a></li>
                    <li><a class="footer-social-link x" href="https://x.com/CommunityCVS" aria-label="X">X</a></li>
                </ul>
            </div>
            <p class="footer-legals"><span class="copyright">&copy; Copyright CommunityCVS <?php echo date( 'Y' ); ?></span> | <a href="#">Privacy Policy</a> | <a href="#">Accessibility</a> | <a href="#">Customer Care Policy</a> | <a href="#">Data Privacy Notice</a></p>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
