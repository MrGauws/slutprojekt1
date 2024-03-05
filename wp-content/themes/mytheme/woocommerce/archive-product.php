<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>

<div class="archive-product-container">
    <?php
    // Add your shortcode here to be displayed to the left of the products
    echo do_shortcode('[wcapf_form]');
    ?>

    <div class="products">
        <?php
        if ( woocommerce_product_loop() ) {
            woocommerce_product_loop_start();

            while ( have_posts() ) {
                the_post();
                wc_get_template_part( 'content', 'product' );
            }

            woocommerce_product_loop_end();
        } else {
            do_action( 'woocommerce_no_products_found' );
        }
        ?>
    </div>
</div>

<div class="load-more">
    <button id="load-more-button">Load More Products</button>
</div>

<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
//do_action( 'woocommerce_sidebar' );
?>

<script type="text/javascript">
    jQuery(function($){
        var page = 2; // Start page for AJAX request
        var loading = false; // Variable to prevent multiple AJAX loads

        $(document).on('click', '#load-more-button', function(){
            if( ! loading ) {
                loading = true;
                var data = {
                    'action': 'my_load_more_products',
                    'query': <?php echo json_encode( $GLOBALS['wp_query']->query_vars ); ?>,
                    'page': page
                };

                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    data: data,
                    type: 'POST',
                    success: function(response) {
                        $('#products').append(response);
                        page++;
                        loading = false;
                    }
                });
            }
        });
    });
</script>

<?php
get_footer( 'shop' );
