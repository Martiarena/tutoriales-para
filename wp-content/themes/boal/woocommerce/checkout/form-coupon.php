<?php
/**
 * Checkout coupon form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! WC()->cart->coupons_enabled() ) {
    return;
}

$info_message = apply_filters( 'woocommerce_checkout_coupon_message', esc_html__( 'Have a coupon?', 'woocommerce' ) . ' <a href="#" class="showcoupon">' . esc_html__( 'Click here to enter your code', 'woocommerce' ) . '</a>' );
wc_print_notice( $info_message, 'notice' );
?>

<form class="checkout_coupon boal-coupon" method="post" style="display:none">
    <div class="coupon input-group">
        <span class="input-group-addon" for="coupon_code"><?php esc_attr_e( 'Coupon:', 'woocommerce' ); ?></span>

        <input type="text" placeholder="Coupon code" value="" id="coupon_code" class="input-text form-control" name="coupon_code">

        <span class="input-group-btn">
            <input type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'woocommerce' ); ?>" />
        </span>
    </div>
    <div class="clear"></div>
</form>

