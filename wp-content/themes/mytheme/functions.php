<?php

if(!defined('ABSPATH')){
    exit;
}
require_once('vite.php');
require_once('ajax.php');
//initialize theme
require_once(get_template_directory() . '/init.php');

function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );


add_action('wp_enqueue_scripts', 'enqueue_woocommerce_scripts');

function enqueue_woocommerce_scripts() {
    if (function_exists('is_woocommerce') && is_woocommerce()) {
        wp_enqueue_script('wc-add-to-cart-variation');
    }
}

function custom_theme_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Shop Sidebar', 'custom-theme' ),
        'id'            => 'shop-sidebar',
        'description'   => __( 'Add widgets here to appear on the Shop page.', 'custom-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'custom_theme_widgets_init' );


// Funktion för att hantera AJAX-begäran för att spara liked-statusen
function save_product_like_status() {
    // Hämta produkt-ID från AJAX-begäran
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    
    // Spara liked-statusen i sessionen eller någon annanstans om användaren inte är inloggad
    // Här kan du använda din egen logik för att spara statusen, till exempel i sessionen eller genom en cookie

    // Skicka ett svar tillbaka till JavaScript
    echo json_encode(array('success' => true));
    
    // Viktigt att avsluta scriptet efter AJAX-hanteringen
    wp_die();
}
add_action('wp_ajax_save_product_like_status', 'save_product_like_status');
add_action('wp_ajax_nopriv_save_product_like_status', 'save_product_like_status');


function enqueue_custom_scripts() {
    // Enqueue the custom JavaScript file
    wp_enqueue_script('custom-checkout-scripts', get_template_directory_uri() . '/resources/js/checkout.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');