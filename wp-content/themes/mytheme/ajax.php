<?php 

function init_ajax(){
    add_action("wp_ajax_mytheme_getbyajax", "mytheme_getbyajax");
    add_action("wp_ajax_nopriv_mytheme_getbyajax", "mytheme_getbyajax");

    add_action("wp_enqueue_scripts", "mytheme_enqueue_scripts");
}

add_action("init", "init_ajax");

function mytheme_enqueue_scripts(){
    if ( ! is_checkout() ) {
        wp_enqueue_script("mytheme_jquery", get_template_directory_uri() . "/resources/js/jquery.js", array(), false, true);
    }

    // Lägg till din ajax.js-fil här
    wp_enqueue_script("mytheme_ajax", get_template_directory_uri() . "/resources/js/ajax.js", array("mytheme_jquery"), false, true);
    wp_enqueue_script('move_payment', get_template_directory_uri() . '/resources/js/checkout.js', array('jquery'), '1.0', true);

    // Här kan du lägga till fler script om det behövs

    // Lokalisera variabler för ajax.js-filen
    $localize_success = wp_localize_script("mytheme_ajax", "ajax_variabels", array(
        "ajaxUrl" => admin_url("admin-ajax.php"),
        "nonce" => wp_create_nonce("mytheme_ajax_nonce"),
    ));

    if ( ! $localize_success ) {
        // Felhantering om lokaliseringsprocessen misslyckas
        error_log("Failed to localize ajax_variabels in mytheme_ajax script.");
    }
}

function mytheme_getbyajax(){
    $result = array();
    wp_send_json($result);
}
?>