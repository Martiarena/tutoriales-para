<?php
/**
 * Thankyou page
 *
 * This template can be boalridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( $order ) : ?>

    <?php if ( $order->has_status( 'failed' ) ) : ?>

        <p class="woocommerce-thankyou-order-failed"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

        <p class="woocommerce-thankyou-order-failed-actions">
            <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="btn btn-default pay"><?php _e( 'Pay', 'woocommerce' ) ?></a>
            <?php if ( is_user_logged_in() ) : ?>
                <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="btn btn-default pay"><?php _e( 'My Account', 'woocommerce' ); ?></a>
            <?php endif; ?>
        </p>

    <?php else : ?>
        <div class="thankyou-order">
            <p class="woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); ?></p>
        </div>
        <div class="thankyou-order-details">
            <ul class="woocommerce-thankyou-order-details order_details clearfix">
                <li class="order">
                    <?php _e( 'Order Number:', 'woocommerce' ); ?>
                    <strong><?php echo  $order->get_order_number(); ?></strong>
                </li>
                <li class="date">
                    <?php _e( 'Date:', 'woocommerce' ); ?>
                    <strong><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->get_date_created() ) ); ?></strong>
                </li>
                <li class="total">
                    <?php _e( 'Total:', 'woocommerce' ); ?>
                    <strong><?php echo  $order->get_formatted_order_total(); ?></strong>
                </li>
                <?php if ( $order->get_payment_method_title() ) : ?>
                    <li class="method">
                        <?php _e( 'Payment Method:', 'woocommerce' ); ?>
                        <strong><?php echo  $order->get_payment_method_title(); ?></strong>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="clear"></div>

    <?php endif; ?>
    <div class="thankyou-order-payment-details">
        <?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
        <?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>
    </div>
<?php else : ?>

    <p class="woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></p>

<?php endif; ?>
