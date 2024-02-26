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