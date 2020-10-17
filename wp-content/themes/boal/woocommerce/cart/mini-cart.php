<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be boalridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>
<div class="cart_container uk-offcanvas-bar uk-offcanvas-bar-flip" data-text-emptycart="<?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?>">
    <div class="cart-panel">
        <div class="cart-header">
            <div class="cart-panel-title clearfix">
                <span class="mycart pull-left"><?php esc_html_e('My Cart','boal');?></span>
                <span class="close pull-right"><?php esc_html_e('Close','boal');?></span>
            </div>

        </div>
        <div id="cart-panel-loader" class="">
            <h5 class="loader"><?php esc_html_e('Updating ...','boal');?></h5>
        </div>
        <div class="cart_list">
            <ul class="product_list_widget">
                <?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>
                    <?php
                    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                        $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                        $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                        $thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                            ?>
                            <li class="media">
                                <a href="<?php echo get_permalink( $product_id ); ?>" class="cart-image">
                                    <?php echo  $thumbnail; ?>
                                </a>
                                <div class="cart-main-content">
                                    <div class="name">
                                        <a href="<?php echo get_permalink( $product_id ); ?>">
                                            <?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );; ?>
                                        </a>
                                    </div>
                                    <p class="cart-item">
                                        <?php echo WC()->cart->get_item_data( $cart_item ); ?>
                                        <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ) ) . '</span>', $cart_item, $cart_item_key ); ?>
                                    </p>
                                </div>
                                <?php
                                echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" data-cart-item-key="%s" class="rit_product_remove remove" title="%s"><i class="fa fa-close"></i></a>',
                                    esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
                                    $cart_item_key,
                                    esc_html__( 'Remove product', 'boal' )
                                ), $cart_item_key );
                                ?>

                            </li>
                        <?php
                        }
                    }
                    ?>

                <?php else : ?>

                    <li class="empty"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></li>

                <?php endif; ?>
            </ul><!-- end product list -->
        </div>
        <div class="cart-bottom">
            <?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

            <p class="total clearfix"><strong><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?>:</strong><span class="mini-cart-subtotal"><?php echo WC()->cart->get_cart_subtotal(); ?></span></p>

            <?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

            <p class="buttons clearfix">
                <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="btn btn-default  pull-left"><?php esc_html_e( 'View Cart', 'woocommerce' ); ?></a>
                <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn btn-primary  pull-right"><?php esc_html_e( 'Checkout', 'woocommerce' ); ?></a>
            </p>

        <?php endif; ?>
        </div>
    </div>
</div>