<?php
/**
 * My Account page
 *
 * This template can be boalridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

/**
 * My Account navigation.
 * @since 2.6.0
 */
?>
<div class="row">

	<div class="col-md-3 sidebar ">

		<div class="my-account">
			<div class="author-img avatar">
				<?php echo get_avatar( $current_user->user_email,100); ?>
			</div>
			<div class="name-account">
			<?php
				echo sprintf( esc_html__( 'Hello %s', 'boal' ),
						'<strong>'.$current_user->display_name.'</strong>'
				);
			?>
			</div>
			<a class="btn-logout"  href="<?php echo wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>"><?php _e( 'Logout', 'boal' ); ?></a>

		</div>
		<?php do_action( 'woocommerce_account_navigation' ); ?>
	</div>

	<div class="col-md-9">
		<div class="woocommerce-MyAccount-content content-inner woo-dashboard">
			<?php
			/**
			 * My Account content.
			 * @since 2.6.0
			 */
			do_action( 'woocommerce_account_content' );
			?>
		</div>
	</div>

</div>



