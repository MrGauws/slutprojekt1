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



// Funktionen för att skapa stjärnbetyget
add_action( 'woocommerce_after_shop_loop_item_title', 'add_custom_rating_pro', 5 );
function add_custom_rating_pro() {
    global $product;

    // Kontrollera om produkten har recensioner
    if ( $product->get_review_count() > 0 ) {
        $average_rating = $product->get_average_rating();
        $rating_count = $product->get_review_count();

        // Skapa HTML för stjärnbetyget
        $output = '<div class="woocommerce-product-rating">';

        // Rita fyllda stjärnor baserat på genomsnittligt betyg
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= round($average_rating)) {
                $output .= '<span class="star filled">★</span>';
            } else {
                $output .= '<span class="star">★</span>';
            }
        }

        $output .= '</div>';

        // Skriv ut stjärnbetyget
        echo $output;
    }
}



add_filter( 'woocommerce_checkout_cart_item_class', 'custom_checkout_cart_item_class', 10, 3 );
function custom_checkout_cart_item_class( $class, $cart_item, $cart_item_key ) {
    $class[] = 'custom-width'; // Lägg till klassen 'custom-width'
    return $class;
}




function replace_add_to_cart_text( $translated_text, $text, $domain ) {
    if ( 'woocommerce' === $domain && 'Add to cart' === $text ) {
        $translated_text = 'Buy Now';
    }
    return $translated_text;
}
add_filter( 'gettext', 'replace_add_to_cart_text', 20, 3 );


function enqueue_custom_email_styles() {
    // Ladda CSS-filen för e-postmallen
    wp_enqueue_style('custom-email-styles', get_template_directory_uri() . 'wp-content/themes/mytheme/woocommerce/emails/email-styles.css');
}
add_action('woocommerce_email_header', 'enqueue_custom_email_styles');

