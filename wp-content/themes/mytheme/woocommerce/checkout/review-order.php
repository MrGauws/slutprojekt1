<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="row">
    <div class="left-column">
        <table class="shop_table woocommerce-checkout-review-order-table">
            <thead>
                <tr>
                    <th class="product-name"><?php esc_html_e( 'Summary', 'woocommerce' ); ?></th>
                </tr>
            </thead>
            <tbody>
            <?php
            do_action( 'woocommerce_review_order_before_cart_contents' );

            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                    ?>
                    <tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                        <td class="product-thumbnail">
                            <?php
                            $thumbnail = $_product->get_image(array( 40, 40 )); // Define the size of the thumbnail
                            if ($thumbnail) {
                                echo wp_kses_post($thumbnail);
                            }
                            ?>
                        </td>
                        <td class="product-name">
                            <?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ) . '&nbsp;'; ?>
                            <?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times;&nbsp;%s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            <?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </td>
                        <td class="product-total">
                            <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </td>
                    </tr>
                    <?php
                }
            }

            do_action( 'woocommerce_review_order_after_cart_contents' );
            ?>
        </tbody>
            <tfoot>

            <?php
                // FETCHES CUSTOMER INFO
                $billing_address = WC()->customer->get_billing_address();
                ?>

                <!-- SHOWS BILLING ADDRESS IF PROVIDED -->
                <tr class="cart-address">
                    <th><?php esc_html_e('Address', 'woocommerce'); ?></th>
                    <td><?php echo esc_html( $billing_address ); ?></td>
                </tr>

                <tr class="cart-ship">
                    <th><?php esc_html_e( 'Shipment method', 'woocommerce' ); ?></th>
                    <td>
                    <?php
                        $shipping_methods = WC()->session->get('chosen_shipping_methods');
                        $chosen_shipping = $shipping_methods[0];

                        // TRANSLATES
                        function translate_shipping_method($method_id) {
                            switch ($method_id) {
                                case 'free_shipping:1':
                                    return 'Fri Frakt';
                                case 'flat_rate:2':
                                    return 'PostNord';
                                case 'flat_rate:3':
                                    return 'DB Schenker';
                                case 'flat_rate:4':
                                    return 'DB Schenker ++';
                                default:
                                    return __( $method_id, 'woocommerce' );
                            }
                        }

                        // CALLS THE TRANSLATION
                        $translated_shipping = translate_shipping_method($chosen_shipping);

                        echo $translated_shipping;
                        ?>
                    </td>
                </tr>
                
                <!-- SUBTOTAL MENU THAT SHOWS PRICE - TAX  -->
                <tr class="cart-subtotal">
                    <th><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
                    <td>
                        <?php
                        $subtotal = WC()->cart->subtotal;
                        $tax_total = WC()->cart->tax_total; 
                        $subtotal_excluding_tax = $subtotal - $tax_total; 
                        echo wc_price( $subtotal_excluding_tax );
                        ?>
                    </td>
                </tr>
                <!-- ESTIMATED TAX  -->
                <tr class="cart-taxx">
                    <th><?php esc_html_e( 'Estimated Tax', 'woocommerce'); ?></th>
                    <td><?php wc_cart_totals_taxes_total_html(); ?></td>
                </tr>

                <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                    <tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                        <th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
                        <td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

                    <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

                    <?php wc_cart_totals_shipping_html();?>
                    

                    <?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

                <?php endif; ?>

                <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
                    <tr class="fee">
                        <th><?php echo esc_html( $fee->name ); ?></th>
                        <td><?php wc_cart_totals_fee_html( $fee ); ?></td>
                    </tr>
                <?php endforeach; ?>

                

                <?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

                <tr class="order-total">
                    <th><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
                    <td><?php wc_cart_totals_order_total_html(); ?></td>
                </tr>

                <?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

            </tfoot>
        </table>
    </div>
    <div class="right-column">
        <?php
        // SHOWS PAYMENT
        do_action('woocommerce_checkout_payment');
        ?>
    </div>
</div>