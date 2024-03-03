<?php
// Function to generate WooCommerce product category subheader navigation
function custom_woocommerce_category_subheader_navigation() {
    // Get product categories
    $product_categories = get_terms( array(
        'taxonomy' => 'product_cat',
        'hide_empty' => false,
    ) );

    // Initialize output variable
    $output = '';

    // Check if there are product categories
    if ($product_categories) {
        $output .= '<div class="subheader-navigation">';
        $output .= '<ul>';
        
        // Loop through product categories
        foreach ($product_categories as $category) {
            // Exclude "Uncategorized"
            if ($category->parent == 0 && $category->name != 'Uncategorized') {
                // Get category thumbnail
                $thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
                $image = wp_get_attachment_url( $thumbnail_id );

                // Output category with thumbnail
                $output .= '<li><img src="' . $image . '" alt="' . $category->name . '">';
                $output .= '<a href="' . get_term_link($category) . '">' . $category->name . '</a></li>';
            }
        }

        $output .= '</ul>';
        $output .= '</div>';
    }

    // Return the output
    return $output;
}
add_shortcode('woocommerce_category_subheader_navigation', 'custom_woocommerce_category_subheader_navigation');




add_shortcode('live_search', 'live_search_function');
function live_search_function() { ?>

    <input type="text" name="keyword" id="keyword" placeholder="Search" onkeyup="fetch()"></input>

    <div id="productfetch"></div>

    <?php
}

add_action( 'wp_footer', 'ajax_fetch' );
function ajax_fetch() { ?>

<script type="text/javascript">

    function fetch() {
        
        if( document.getElementById('keyword').value.trim().length == 0 ) {

            jQuery('#productfetch').html('');

        } else {

            jQuery.ajax( {

                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'post',
                data: { action: 'data_fetch', keyword: jQuery('#keyword').val() },
                success: function(data) {
                    jQuery('#productfetch').html( data );
                }
            });
        }
    }
    // Denna funktion visar productfetch när användaren börjar skriva
    jQuery(document).ready(function() {
            jQuery('#keyword').on('input', function() {
                if (jQuery(this).val().length > 0) {
                    jQuery('#productfetch').show();
                } else {
                    jQuery('#productfetch').hide();
                }
            });
        });
</script>
<?php
}

add_action('wp_ajax_data_fetch' , 'product_fetch');
add_action('wp_ajax_nopriv_data_fetch','product_fetch');
function product_fetch() {

    $the_query = new WP_Query( array( 'posts_per_page' => -1, 's' => esc_attr( $_POST['keyword'] ), 'post_type' => 'product' ) );

    if( $the_query->have_posts() ) :
        while( $the_query->have_posts() ): $the_query->the_post(); ?>
    <div class="product-li">
    <h3><a href="<?php echo esc_url( post_permalink() ); ?>"><?php the_title();?></a></h3>
    <?php
    // Hämta bild för produkten
            $thumbnail_id = get_post_thumbnail_id();
            $image_url = wp_get_attachment_image_src($thumbnail_id, 'thumbnail');
            if ($image_url) {
                ?>
                <img src="<?php echo $image_url[0]; ?>" alt="<?php the_title_attribute(); ?>">
                <?php
            }
            ?> 
            </div>
        <?php endwhile;
        wp_reset_postdata();
    endif;
die();
}