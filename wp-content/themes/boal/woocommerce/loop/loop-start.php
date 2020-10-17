<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
global $woocommerce_loop;
$number                  = get_theme_mod('boal_woo_number_product','3');
?>

<ul class="products-block row affect-isotope clearfix" data-number="<?php echo esc_attr($number);?>">
