<?php
    global $product;

?>
<div class="product-block product inner-product-content">
        <figure class="caption-image product-image">
            <?php
                do_action( 'woocommerce_before_shop_loop_item' );
                    do_action( 'woocommerce_before_shop_loop_item_title' );
                do_action( 'woocommerce_after_shop_loop_item' );

            ?>

        </figure>
        <div class="caption-product">
            <div class="caption">
                <h3 class="product-name">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
                <div class="product-price">
                    <?php woocommerce_template_loop_price(); ?>
                </div>
            </div>
            <div class="button-groups clearfix">
                <?php do_action('boal_yith_wishlist' );?>
            </div>
            <div class="ground-addcart hidden">
                <?php do_action( 'woocommerce_add_to_cart_item' ); ?>
            </div>
        </div>
</div>