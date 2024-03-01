<?php
function change_breadcrumb_delimiter( $defaults ) {
    // Hämta URL för ikonen från media library
    $icon_url = 'http://slutprojekt1.test/wp-content/uploads/2024/02/Arrow.png';

    // Byt ut delimitern mot ikonen
    $defaults['delimiter'] = '<img src="' . esc_url( $icon_url ) . '" alt="Breadcrumb Icon" class="breadcrumb-icon">';

    return $defaults;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'change_breadcrumb_delimiter' );




?>

<?php
function custom_modify_shipping_heading( $translated_text, $text, $domain ) {
    // Kolla om texten matchar "Shipping" och är i rätt domän
    if ( $text === 'Shipping' && $domain === 'woocommerce' ) {
        // Ändra texten till "Estimated shipping and Handling"
        $translated_text = __( 'Estimated shipping and Handling', 'woocommerce' );
    }
    return $translated_text;
}
add_filter( 'gettext', 'custom_modify_shipping_heading', 20, 3 );
?>