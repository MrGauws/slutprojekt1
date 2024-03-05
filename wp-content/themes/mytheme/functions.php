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
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    echo json_encode(array('success' => true));
    wp_die();
}
add_action('wp_ajax_save_product_like_status', 'save_product_like_status');
add_action('wp_ajax_nopriv_save_product_like_status', 'save_product_like_status');








function enqueue_custom_scripts() {
    wp_enqueue_script('custom-checkout-scripts', get_template_directory_uri() . '/resources/js/checkout.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');









add_action( 'wp_ajax_my_load_more_products', 'my_load_more_products_ajax' );
add_action( 'wp_ajax_nopriv_my_load_more_products', 'my_load_more_products_ajax' );

function my_load_more_products_ajax() {
    $page = $_POST['page'];
    $products_per_page = 6; 
    $offset = ($page - 1) * $products_per_page;

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $products_per_page,
        'offset' => $offset,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            wc_get_template_part('content', 'product');
        }
    }

    wp_reset_postdata();
    die();
}

add_action( 'wp_footer', 'ajax_load_more_products' );
function ajax_load_more_products() { ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            var page = 2; 
            var canLoad = true; 

            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() == $(document).height()) {
                    if (canLoad) {
                        fetchProducts();
                    }
                }
            });

            function fetchProducts() {
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'post',
                    data: {
                        action: 'my_load_more_products', 
                        page: page,
                    },
                    success: function(response) {
                        if (response.trim() != '') {
                            var $productsContainer = $('.products.columns-3');
                            $productsContainer.append(response);
                            page++;
                        } else {
                            canLoad = false; 
                        }
                    }
                });
            }
        });
    </script>
<?php }

add_action( 'pre_get_posts', 'custom_products_per_page' );
function custom_products_per_page( $query ) {
    if ( ! is_admin() && is_post_type_archive( 'product' ) && $query->is_main_query() ) {
        $query->set( 'posts_per_page', 6 ); 
    }
}

function mytheme_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Shop Widget Area', 'mytheme' ),
        'id'            => 'shop_widget_area',
        'description'   => __( 'Widget area for the shop page.', 'mytheme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'mytheme_widgets_init' );






// widget-området shopsidan
add_action( 'woocommerce_before_main_content', 'mytheme_display_shop_widget_area', 10 );
function mytheme_display_shop_widget_area() {
    if ( is_active_sidebar( 'shop_widget_area' ) ) {
        echo '<div id="shop-widget-area" class="shop-widget-area">';
        dynamic_sidebar( 'shop_widget_area' );
        echo '</div>';
    }
}







?>

