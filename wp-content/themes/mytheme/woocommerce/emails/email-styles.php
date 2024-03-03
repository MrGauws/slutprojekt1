<?php
/**
 * Email Styles
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-styles.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 8.6.0
 */

if (!defined('ABSPATH')) {
    exit;
}

// Load colors.
$bg        = get_option('woocommerce_email_background_color');
$body      = get_option('woocommerce_email_body_background_color');
$base      = get_option('woocommerce_email_base_color');
$base_text = wc_light_or_dark($base, '#202020', '#ffffff');
$text      = get_option('woocommerce_email_text_color');

// Pick a contrasting color for links.
$link_color = wc_hex_is_light($base) ? $base : $base_text;

if (wc_hex_is_light($body)) {
    $link_color = wc_hex_is_light($base) ? $base_text : $base;
}

$bg_darker_10    = wc_hex_darker($bg, 10);
$body_darker_10  = wc_hex_darker($body, 10);
$base_lighter_20 = wc_hex_lighter($base, 20);
$base_lighter_40 = wc_hex_lighter($base, 40);
$text_lighter_20 = wc_hex_lighter($text, 20);
$text_lighter_40 = wc_hex_lighter($text, 40);

// !important; is a gmail hack to prevent styles being stripped if it doesn't like something.
// body{padding: 0;} ensures proper scale/positioning of the email in the iOS native email app.
?>
body {
    background-color: <?php echo esc_attr($bg); ?>;
    padding: 0;
    text-align: center;
}

/* Remove all borders */
table,
tr,
td,
th {
  border: none !important;
}

#outer_wrapper {
    background-color: <?php echo esc_attr($bg); ?>;
}

#wrapper {
    margin: 0 auto;
    padding: 70px 0;
    -webkit-text-size-adjust: none !important;
    width: 100%;
    max-width: 600px;
}

#template_container {
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1) !important;
    background-color: <?php echo esc_attr($body); ?>;
    border: 1px solid #000;
    border-radius: 10px !important;
	justify-content: center;
}

#template_header {
    background-color: #00000;
    border-radius: 10px 10px 0 0 !important;
    color: <?php echo esc_attr($base_text); ?>;
    border-bottom: 0;
    font-weight: bold;
    line-height: 100%;
    vertical-align: middle;
    font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;
    position: relative; /* Lägg till position: relative för att använda positionering av logotyp */
}

#template_header::before {
    content: '';
	left: 15%;
    background-image: url('https://slutprojekt1.test/wp-content/uploads/2024/02/Logo-1.png'); 
    background-repeat: no-repeat;
    background-size: contain; /* Justera storleken på logotypen */
    width: 100px; /* Justera bredden på logotypen */
    height: 50px; /* Justera höjden på logotypen */
    position: absolute; /* Positionera logotypen relativt till #template_header */
    left: 10px; /* Justera logotypens position till vänster */
    top: 50%; /* Centrera logotypen vertikalt */
    transform: translateY(-50%); /* Justera logotypens position vertikalt */
}

#template_header h1,
#template_header h1 a {
    color: <?php echo esc_attr($base_text); ?>;
    background-color: inherit;
}

#template_header_image img {
    margin-left: 0;
    margin-right: 0;
}

#template_footer td {
    padding: 0;
    border-radius: 6px;
}

#template_footer #credit {
    border: 0;
    color: <?php echo esc_attr($text_lighter_40); ?>;
    font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;
    font-size: 12px;
    line-height: 150%;
    text-align: center;
    padding: 24px 0;
}

#template_footer #credit p {
    margin: 0 0 16px;
}

#body_content {
    background-color: <?php echo esc_attr($body); ?>;
}

#body_content table td {
    padding: 48px 48px 32px;
}

#body_content table td td {
    padding: 12px;
}

#body_content table td th {
    padding: 12px;
}

#body_content td ul.wc-item-meta {
    font-size: small;
    margin: 1em 0 0;
    padding: 0;
    list-style: none;
}

#body_content td ul.wc-item-meta li {
    margin: 0.5em 0 0;
    padding: 0;
}

#body_content td ul.wc-item-meta li p {
    margin: 0;
}

#body_content p {
    margin: 0 0 16px;
}

#body_content h2 {
    color: #00000;
    display: block;
    font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;
    font-size: 18px;
    font-weight: bold;
    line-height: 130%;
    margin: 0 0 18px;
    text-align: left;
}

#body_content_inner {
    color: <?php echo esc_attr($text); ?>;
    font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;
    font-size: 14px;
    line-height: 150%;
    text-align: left;
}

#addresses td {
    text-align: left;
    font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;
    padding: 0;
}

#addresses h2 {
    color: #00000;
    display: block;
    font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;
    font-size: 18px;
    font-weight: bold;
    line-height: 130%;
    margin: 0 0 18px;
    text-align: left;
}

.address {
    padding: 12px;
    color: <?php echo esc_attr($text); ?>;
    
}

.address a {
    color: #00000;
    font-weight: normal;
    text-decoration: underline;
}

.order_item {
    background-color: #F6F6F6;
}

.order_item td {
    color: <?php echo esc_attr($text); ?>;
    
    padding: 12px;
    text-align: left;
    vertical-align: middle;
    font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;
    word-wrap: break-word;
}

.order_item .woocommerce-Price-amount.amount {
    color: <?php echo esc_attr($text); ?>;
}

.order_item .woocommerce-Price-currencySymbol {
    color: <?php echo esc_attr($text); ?>;
}

.order_item th.td {
    color: <?php echo esc_attr($text); ?>;
    
    vertical-align: middle;
    padding: 12px;
    text-align: left;
}

.order_item tfoot th.td {
    color: <?php echo esc_attr($text); ?>;
    
    vertical-align: middle;
    padding: 12px;
    text-align: left;
    border-top-width: 4px;
}

.order_item tfoot th.td {
    color: <?php echo esc_attr($text); ?>;
    
    vertical-align: middle;
    padding: 12px;
    text-align: left;
}

.order_item tfoot td.td {
    color: <?php echo esc_attr($text); ?>;
    
    vertical-align: middle;
    padding: 12px;
    text-align: left;
}

.order_item tfoot td.td .woocommerce-Price-amount.amount {
    color: <?php echo esc_attr($text); ?>;
}

.order_item tfoot td.td .woocommerce-Price-currencySymbol {
    color: <?php echo esc_attr($text); ?>;
}
#header_wrapper {
    text-align: center; /* Centrera texten horisontellt */
    padding: 36px 48px; /* Justera padding för att centrera innehållet vertikalt */
    position: relative; /* Lägg till position: relative för att använda positionering av text */
}
#header_wrapper h1 {
    color: #fff;
    background-color: inherit;
    font-size: 24px; /* Justera textstorleken */
    position: absolute; /* Positionera texten relativt till #header_wrapper */
    left: 27%; /* Placera texten 5% från vänsterkanten */
    top: 25%; /* Centrera texten vertikalt */
    transform: translateY(-25%); /* Justera textens position vertikalt */
}