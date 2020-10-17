<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$style_css                  ="";
$bg_header                  = get_theme_mod('boal_woo_cat_breadcrumb_image');
$bg_header_color            = get_theme_mod('boal_cat_bg');
if($bg_header){
    $cat_header           ="background-image:url('$bg_header')";
    $style_css            ='style = '.$cat_header.'';
}
if($bg_header_color){
    $cat_header           ="background:$bg_header_color";
    $style_css            ='style = '.$cat_header.'';
}

get_header( 'shop' ); ?>

<div class="top-products clearfix">
    <div class="cat-header clearfix" <?php echo esc_attr($style_css);?>>
        <div class="container">
            <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                <h1 class="woocommerce-products-header__title title-page"><?php woocommerce_page_title(); ?></h1>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="container shop-content clearfix">
    <?php do_action('woo-sidebar-left'); ?>
    <?php do_action('woo-content-before'); ?>

        <?php if ( have_posts() ) : ?>
            <div class="shop-content-top clearfix">
                <?php
                /**
                 * woocommerce_before_shop_loop hook.
                 *
                 * @hooked wc_print_notices - 10
                 * @hooked woocommerce_result_count - 20
                 * @hooked woocommerce_catalog_ordering - 30
                 */
                do_action( 'woocommerce_before_shop_loop' );
                ?>
            </div>


            <?php woocommerce_product_loop_start(); ?>

            <?php woocommerce_product_subcategories(); ?>

            <?php while ( have_posts() ) : the_post(); ?>

                <?php
                /**
                 * woocommerce_shop_loop hook.
                 *
                 * @hooked WC_Structured_Data::generate_product_data() - 10
                 */
                do_action( 'woocommerce_shop_loop' );
                ?>

                <?php wc_get_template_part( 'content', 'product' ); ?>

            <?php endwhile; // end of the loop. ?>

            <?php woocommerce_product_loop_end(); ?>

            <?php
            /**
             * woocommerce_after_shop_loop hook.
             *
             * @hooked woocommerce_pagination - 10
             */
            do_action( 'woocommerce_after_shop_loop' );
            ?>

        <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
            <?php
            /**
             * woocommerce_no_products_found hook.
             *
             * @hooked wc_no_products_found - 10
             */
            do_action( 'woocommerce_no_products_found' );
            ?>
        <?php endif; ?>

    <?php do_action('woo-content-after'); ?>
    <?php do_action('woo-sidebar-right'); ?>
</div>







<?php
/**
 * woocommerce_sidebar hook.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );
?>

<?php get_footer( 'shop' ); ?>




