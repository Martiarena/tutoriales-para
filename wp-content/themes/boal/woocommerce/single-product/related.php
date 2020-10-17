<?php
/**
 * Related Products
 *
 * This template can be boalridden by copying it to yourtheme/woocommerce/single-product/related.php.
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
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if(isset($product_number) || empty($product_number)){
    $product_number=4;
}

if ( $related_products ) : ?>

    <div class="widget widget-related products-block center">

        <h2 class="widgettitle"><?php esc_html_e( 'Related products', 'woocommerce' ); ?></h2>

        <div class="related-wrapper">
            <div class="products-block">
                <div class="na-carousel products-row" data-number="<?php echo esc_attr($product_number); ?>">

                    <?php foreach ( $related_products as $related_product ) : ?>

                        <?php
                        $post_object = get_post( $related_product->get_id() );

                        setup_postdata( $GLOBALS['post'] =& $post_object );

                        wc_get_template_part( 'content', 'product-related' ); ?>

                    <?php endforeach; ?>

                </div>
            </div>
        </div>

    </div>

<?php endif;

wp_reset_postdata();
