<?php
/**
 * Add payment method form form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

?>
<form id="add_payment_method" method="post" class="featured-box align-left">
    <div class="box-content">
        <div id="payment">
            <ul class="payment_methods methods">
                <?php
                    if ( $available_gateways = WC()->payment_gateways->get_available_payment_gateways() ) {
                        // Chosen Method
                        if ( sizeof( $available_gateways ) )
                            current( $available_gateways )->set_current();

                        foreach ( $available_gateways as $gateway ) {
                            ?>
                            <li class="payment_method_<?php echo esc_attr($gateway->id); ?>">
                                <input id="payment_method_<?php echo esc_attr($gateway->id); ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> />
                                <label for="payment_method_<?php echo esc_attr($gateway->id); ?>"><?php echo esc_attr($gateway->get_title()); ?> <?php echo esc_attr($gateway->get_icon()); ?></label>
                                <?php
                                    if ( $gateway->has_fields() || $gateway->get_description() ) {
                                        echo '<div class="payment_box payment_method_' . $gateway->id . '" style="display:none;">';
                                        $gateway->payment_fields();
                                        echo '</div>';
                                    }
                                ?>
                            </li>
                            <?php
                        }
                    } else {

                        echo '<p>' . esc_html__( 'Sorry, it seems that there are no payment methods which support adding a new payment method. Please contact us if you require assistance or wish to make alternate arrangements.', 'boal' ) . '</p>';

                    }
                ?>
            </ul>

            <div class="form-row clearfix">
                <?php wp_nonce_field( 'woocommerce-add-payment-method' ); ?>
                <input type="submit" class="button btn-lg pt-right alt" id="place_order" value="<?php esc_html_e( 'Add Payment Method', 'boal' ); ?>" />
                <input type="hidden" name="woocommerce_add_payment_method" value="1" />
            </div>

        </div>
    </div>

</form>
