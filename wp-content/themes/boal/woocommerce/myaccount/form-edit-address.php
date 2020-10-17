<?php
/**
 * Edit address form
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.0.9
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $current_user;

$page_title = ( $load_address === 'billing' ) ? esc_html__( 'Billing Address', 'boal' ) : esc_html__( 'Shipping Address', 'boal' );

wp_get_current_user();

?>

<?php wc_print_notices(); ?>

<?php if ( ! $load_address ) : ?>

	<?php wc_get_template( 'myaccount/my-address.php' ); ?>

<?php else : ?>

    <div class="panel panel-default">
        <div class="panel-heading"> <h3><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title ); ?></h3></div>
        <div class="panel-body">
            <form method="post">
                <?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>
                <?php foreach ( $address as $key => $field ) : ?>
                    <?php woocommerce_form_field( $key, $field, ! empty( $_POST[ $key ] ) ? wc_clean( $_POST[ $key ] ) : $field['value'] ); ?>
                <?php endforeach; ?>

                <?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>

                <p class="clearfix">
                    <input type="submit" class="button pt-right" name="save_address" value="<?php esc_html_e( 'Save Address', 'boal' ); ?>" />
                    <?php wp_nonce_field( 'woocommerce-edit_address' ); ?>
                    <input type="hidden" name="action" value="edit_address" />
                </p>

            </form>
        </div>
    </div>


<?php endif; ?>
