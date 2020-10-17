<?php
/**
 * Lost password form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

?>
<div class="panel panel-default">
    <div class="panel-body">
        <?php wc_print_notices(); ?>
        <form method="post" class="lost_reset_password featured-box align-left">

                <?php if( 'lost_password' == $args['form'] ) : ?>

                    <p><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'boal' ) ); ?></p>

                <p class="form-row form-row-first"><label for="user_login"><?php esc_html_e( 'Username or email', 'boal' ); ?></label> <input class="input-text" type="text" name="user_login" id="user_login" /></p>

                <?php else : ?>

                    <p><?php echo apply_filters( 'woocommerce_reset_password_message', esc_html__( 'Enter a new password below.', 'boal') ); ?></p>

                    <p class="form-row form-row-first">
                        <label for="password_1"><?php esc_html_e( 'New password', 'boal' ); ?> <span class="required">*</span></label>
                        <input type="password" class="input-text form-control" name="password_1" id="password_1" />
                    </p>
                    <p class="form-row form-row-last">
                        <label for="password_2"><?php esc_html_e( 'Re-enter new password', 'boal' ); ?> <span class="required">*</span></label>
                        <input type="password" class="input-text" name="password_2" id="password_2" />
                    </p>

                    <input type="hidden" name="reset_key" value="<?php echo isset( $args['key'] ) ? $args['key'] : ''; ?>" />
                    <input type="hidden" name="reset_login" value="<?php echo isset( $args['login'] ) ? $args['login'] : ''; ?>" />

                <?php endif; ?>

                <?php do_action( 'woocommerce_lostpassword_form' ); ?>

                <p class="form-row">
                    <input type="hidden" name="wc_reset_password" value="true" />
                    <input type="submit" class="btn btn-default" value="<?php echo 'lost_password' == $args['form'] ? esc_html__( 'Reset Password', 'boal' ) : esc_html__( 'Save', 'boal' ); ?>" />
                </p>

                <?php wp_nonce_field( $args['form'] ); ?>
        </form>
    </div>
</div>

