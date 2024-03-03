<?php
function change_breadcrumb_delimiter( $defaults ) {
    // Hämta URL för ikonen från media library
    $icon_url = 'https://slutprojekt1.test/wp-content/uploads/2024/02/Arrow.png';

    // Byt ut delimitern mot ikonen
    $defaults['delimiter'] = '<img src="' . esc_url( $icon_url ) . '" alt="Breadcrumb Icon" class="breadcrumb-icon">';

    return $defaults;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'change_breadcrumb_delimiter' );







function change_shipping_text($translated_text, $text, $domain) {
    // Kolla om texten matchar "Shipping" och är i rätt domän
    if ($text === 'Shipping' && $domain === 'woocommerce') {
        // Ändra texten till "Estimated shipping & Handling"
        $translated_text = __('Estimated shipping & Handling', 'woocommerce');
    }
    return $translated_text;
}
add_filter('gettext', 'change_shipping_text', 20, 3);


function add_menu_icons($items, $args) {
    // Kontrollera om det är huvudmenyn och om det finns element
    if ($args->theme_location == 'huvudmeny' && $items) {
        // Ersätt menyval med bilder
        $items = str_replace('User', get_menu_image_html('user'), $items);
        $items = str_replace('Liked', get_menu_image_html('liked'), $items);
        $items = str_replace('Cartt', get_menu_image_html('cart'), $items);
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'add_menu_icons', 10, 2);

// GETS IMAGE FROM LIBRARY BASED ON TITLE
function get_menu_image_html($title) {
    // GETS IMAGE ID FROM LIBRARY BASED ON TITLE
    $image_id = attachment_url_to_postid(get_menu_image_url($title));

    if ($image_id) {
        // GETS THE HTML OF THE IMAGE
        $image_html = wp_get_attachment_image($image_id, 'full', false, array('class' => 'menu-image'));
        return $image_html;
    }
    return ''; 
}

// GETS URL TO IMAGE FROM MEDIA LIBRARY BASED ON TITLE
function get_menu_image_url($title) {
    $args = array(
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'post_status'    => 'inherit',
        'posts_per_page' => 1,
        'title'          => $title,
    );

    $attachments = get_posts($args);

    if ($attachments) {
        return wp_get_attachment_url($attachments[0]->ID);
    }

    return '';
}


// Change "Product" label to "Summary" in the checkout review order table
add_filter('woocommerce_checkout_order_review', 'change_product_label_to_summary');
function change_product_label_to_summary($html) {
    // Replace "Product" with "Summary" in the table header
    $html = str_replace('<th class="product-name">Product</th>', '<th class="product-name">Summary</th>', $html);
    return $html;
}


// Lägg till recensionsstjärnor på produktlistningssidan
add_action( 'woocommerce_after_shop_loop_item_title', 'add_custom_rating_stars', 5 );
function add_custom_rating_stars() {
    global $product;

    // Kontrollera om produkten har recensioner
    if ( $product->get_review_count() > 0 ) {
        $average_rating = $product->get_average_rating();
        $fill_percentage = ($average_rating / 5) * 100; // Beräkna fyllnadsgraden för stjärnorna
        ?>
        <div class="star-rating" style="width: <?php echo esc_attr( $fill_percentage ); ?>%;"></div>
        <?php
    }
}


// Lägg till overlay-element i produktkortet
function add_product_overlay() {
    ?>
    <div class="product-overlay">
        <div class="star-rating-overlay">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </div>
    </div>
    <?php
}
add_action('woocommerce_before_shop_loop_item', 'add_product_overlay');



add_filter( 'woocommerce_checkout_cart_item_class', 'custom_checkout_cart_item_class', 10, 3 );
function custom_checkout_cart_item_class( $class, $cart_item, $cart_item_key ) {
    $class[] = 'custom-width'; // Lägg till klassen 'custom-width'
    return $class;
}

function custom_checkout_ajax_handling() {
    if ( defined('DOING_AJAX') && DOING_AJAX ) {
        return;
    }

    // Ditt AJAX-hanteringskod här
    // Exempel:
    // wp_enqueue_script( 'my-ajax-script', get_template_directory_uri() . '/path/to/ajax.js', array('jquery'), '1.0', true );
    // wp_localize_script( 'my-ajax-script', 'ajax_variabels', array(
    //     'ajaxUrl' => admin_url( 'admin-ajax.php' ),
    //     'nonce' => wp_create_nonce( 'mytheme_ajax_nonce' ),
    // ));

    // Ditt AJAX-hanteringskod här
}
add_action( 'woocommerce_before_checkout_form', 'custom_checkout_ajax_handling' );


function replace_add_to_cart_text( $translated_text, $text, $domain ) {
    if ( 'woocommerce' === $domain && 'Add to cart' === $text ) {
        $translated_text = 'Buy Now';
    }
    return $translated_text;
}
add_filter( 'gettext', 'replace_add_to_cart_text', 20, 3 );