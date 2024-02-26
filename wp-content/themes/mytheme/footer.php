<footer>
    <?php if ( ! is_front_page() ) : ?>
        <!-- FOOTER USP -->
        <section class="footer2">
            <div class="column">
                <h1>Free Delivery</h1>
                <p>For all orders over $50, consectetur adipiscing scing elit.</p>
            </div>
            <div class="column">
                <h2>90 Days Return</h2>
                <p>If goods have problems, consectetur adipiscing scing elit.</p>
            </div>
            <div class="column">
                <h2>Secure Payment</h2>
                <p>100% secure payment, consectetur adipiscing scing elit.</p>
            </div>
        </section>
    <?php endif; ?>
</footer>

<footer>
    <section class="container">
        <div class="footercolumn1">
            <?php
            // GET STORE ADDRESS, CITY, POSTCODE, AND COUNTRY
            $store_address = get_option('woocommerce_store_address');
            $store_city = get_option('woocommerce_store_city');
            $store_postcode = get_option('woocommerce_store_postcode');
            $store_country = get_option('woocommerce_store_country');
            
            // DISPLAY ADDRESS WITH CORRECT SPACING
            echo esc_html($store_address) . '';
            echo esc_html($store_city) . ',<br>';
            echo 'FL ' . $store_postcode . ' USA';
            ?>
        </div>
        <div class="column">
            <span class="category">Links</span>
            <?php
            // DISPLAY PRIMARY MENU IN FOOTER
            $menu_about_us = array(
                'theme_location' => 'huvudmeny',
                'menu_id' => 'footermeny',
                'container' => 'nav',
                'container_class' => 'menu'
            );
            wp_nav_menu($menu_about_us);
            ?>
        </div>
        <div class="column">
            <span class="category">Help</span>
            <div class="column-51">
    
                <?php 
                // DISPLAY FOOTER MENU 2
                $menu = array(
                    'menu' => 'Footer', 
                    'menu_id' => 'footermeny',
                    'container' => 'nav',
                    'theme_location' => 'Footer Menu 1',
                    'container_class' => 'Footer_Menu_1' 
                );

                wp_nav_menu($menu);
                ?>
                
            <!--   <button class="hamburger">&#9776;</button>      -->
            </div>
        </div>
        <div class="column">
            <span class="category">Newsletter</span>
            <div class="newsletter-form">
                <input type="email" placeholder="Enter Your Email Address">
                <button type="submit">SUBSCRIBE</button>
            </div>
        </div>
    </section>
    <div class="footer-border"></div>
    <div class="copyright">
    <p>&copy; <?php echo apply_filters('copyright_year', date("Y")); ?> Meubel House, All rights reserved</p>
    </div>
</footer>

<?php 
wp_footer();
?>
</body>
</html>