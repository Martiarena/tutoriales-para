<?php
/**
 * Pay for order form
 *
 * @author   WooThemes
 * @package  WooCommerce/Templates
 * @version  2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="featured-box align-left">
    <div class="box-content">
        <form id="order_review" method="post">

            <table class="shop_table">
                <thead>
                    <tr>
                        <th class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
                        <th class="product-quantity"><?php esc_html_e( 'Qty', 'woocommerce' ); ?></th>
                        <th class="product-total"><?php esc_html_e( 'Totals', 'woocommerce' ); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ( sizeof( $order->get_items() ) > 0 ) :
                        foreach ( $order->get_items() as $item ) : ?>

                                <tr>
				    <td class="product-name">
					<?php echo esc_html( $item['name'] ); ?>
					<?php $order->display_item_meta( $item ); ?>
				    </td>
				    <td class="product-quantity"><?php echo esc_html( $item['qty'] ); ?></td>
				    <td class="product-subtotal"><?php echo  $order->get_formatted_line_subtotal( $item ); ?></td>
                                </tr>

                        <?php endforeach;
                    endif;
                    ?>
		</tbody>
		<tfoot>
			<?php if ( $totals = $order->get_order_item_totals() ) : ?>
				<?php foreach ( $totals as $total ) : ?>
					<tr>
						<th scope="row" colspan="2"><?php echo  $total['label']; ?></th>
						<td class="product-total"><?php echo  $total['value']; ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tfoot>
            </table>

            <div id="payment">
                <?php if ( $order->needs_payment() ) : ?>
                <h3><?php esc_html_e( 'Payment', 'woocommerce' ); ?></h3>
			<ul class="wc_payment_methods payment_methods methods">
				<?php
					if ( ! empty( $available_gateways ) ) {
						foreach ( $available_gateways as $gateway ) {
							wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
						}
					} else {
						echo '<li>' . apply_filters( 'woocommerce_no_available_payment_methods_message', __( 'Sorry, it seems that there are no available payment methods for your location. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) ) . '</li>';
					}
				?>
			</ul>
                <?php endif; ?>

                <div class="form-row">
			<input type="hidden" name="woocommerce_pay" value="1" />

			<?php wc_get_template( 'checkout/terms.php' ); ?>

			<?php do_action( 'woocommerce_pay_order_before_submit' ); ?>

			<?php echo apply_filters( 'woocommerce_pay_order_button_html', '<input type="submit" class="btn btn-default alt" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '" />' ); ?>

			<?php do_action( 'woocommerce_pay_order_after_submit' ); ?>

			<?php wp_nonce_field( 'woocommerce-pay' ); ?>
                </div>

            </div>

        </form>
    </div>
</div>
