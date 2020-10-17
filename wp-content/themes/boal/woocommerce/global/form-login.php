<?php
/**
 * Login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( is_user_logged_in() ) {
    return;
}

?>
<form method="post" class="login global-login" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>
    <div class="box-login">
        <div class="box-content clearfix">

            <?php do_action( 'woocommerce_login_form_start' ); ?>

            <?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>

            <p class="form-row">
                <label for="username"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?> <span class="required">*</span></label>
                <input type="text" class="input-text" name="username" id="username" />
            </p>
            <p class="form-row">
                <label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
                <input class="input-text" type="password" name="password" id="password" />
            </p>
            <div class="clear"></div>

            <?php do_action( 'woocommerce_login_form' ); ?>

            <p class="form-row clearfix">
                <?php wp_nonce_field( 'woocommerce-login' ); ?>
                <input type="submit" class="button btn-login" name="login" value="<?php esc_html_e( 'Login', 'woocommerce' ); ?>" />
                <input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />


            </p>
            <div class="form-row clearfix">

                <label for="rememberme" class="inline rememberme-inline">
                    <input class="input-inline" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php esc_html_e( 'Remember me', 'woocommerce' ); ?>
                </label>

                <p class="lost_password pull-right">
                    <a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
                </p>

            </div>
            <div class="clear"></div>

            <?php do_action( 'woocommerce_login_form_end' ); ?>

        </div>
    </div>
</form>
