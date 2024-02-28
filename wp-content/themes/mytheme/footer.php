<footer>
    <div class="container">
        <div class="footercolumn footercolumn1">
            <img src="http://slutprojekt1.test/wp-content/uploads/2024/02/Logo-1.png" alt="Logo">
            <p>We are a residential interior design firm located in Portland. Our <br> boutique-studio offers more than</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-tiktok"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        <div class="footercolumn footercolumn2">
            <span class="category">Services</span>
            <?php wp_nav_menu(array('theme_location' => 'footer-menu-1', 'menu' => 'services-menu')); ?>
        </div>
        <div class="footercolumn footercolumn3">
            <span class="category">Assistance to the buyer</span>
            <?php wp_nav_menu(array('theme_location' => 'footer-menu-1', 'menu' => 'assistance-menu')); ?>
        </div>
    </div>
</footer>