<?php
/**
 * The Template for displaying all single products
 *
 * This template can be boalridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<div class="wrapper-breadcrumb clearfix">
		<div class="container">
			<?php boal_woocommerce_breadcrumb(); ?>
			<div class="product-nav">
				<?php boal_next_post_link_product(); ?>
				<?php boal_previous_post_link_product(); ?>
			</div>
		</div>
	</div>

	<div class="container detail-content clearfix">
		<?php do_action('woo-sidebar-detail-left'); ?>
		<?php do_action('woo-content-detail-before'); ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php wc_get_template_part( 'content', 'single-product' ); ?>
		<?php endwhile; // end of the loop. ?>
		<?php do_action('woo-content-detail-after'); ?>
		<?php do_action('woo-sidebar-detail-right'); ?>
	</div>

<?php get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
