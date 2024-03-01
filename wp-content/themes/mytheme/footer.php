<footer>
    <div class="container">
        <div class="footercolumn footercolumn1">
            <img src="http://slutprojekt1.test/wp-content/uploads/2024/02/Logo-1.png" alt="Logo">
            <p>We are a residential interior design firm located in Portland. Our <br> boutique-studio offers more than</p>
            <div class="social-icons">
                <a href="www.twitter.com" target="_blank"><img src="<?=get_template_directory_uri() . '/assets/images/twitter.png';?>" alt="twitter"></a>
                <a href="www.facebook.com" target="_blank"><img src="<?=get_template_directory_uri() . '/assets/images/facebook.png';?>" alt="facebook"></a>
                <a href="www.tiktok.com" target="_blank"><img src="<?=get_template_directory_uri() . '/assets/images/tiktok.png';?>" alt="tik tok"></a>
                <a href="www.instagram.com" target="_blank"><img src="<?=get_template_directory_uri() . '/assets/images/instagram.png';?>" alt="instagram"></a>
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
<?php 
wp_footer();
?>
                </body>
                </html>