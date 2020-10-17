<?php
/**
 * Single Product Share
 *
 * Sharing plugins can hook into here or you can add your own code directly.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
global  $post;
$product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), false, '' );

$woo_facebook = get_theme_mod('boal_woo_share_facebook',false);
$woo_twitter = get_theme_mod('boal_woo_share_twitter',false);
$woo_pinterest = get_theme_mod('boal_woo_share_pinterest',false);
$woo_google = get_theme_mod('boal_woo_share_google',false);
$woo_linkedin = get_theme_mod('boal_woo_share_linkedin',false);

if($woo_facebook || $woo_pinterest): ?>
    <div class="product-share-wrap">
        <div class="product-share">
            <?php if($woo_facebook) : ?>
                <a href="//www.facebook.com/sharer.php?u=<?php echo  esc_url( get_permalink() ); ?>" target="_blank" title="<?php esc_html_e( 'Share on Facebook', 'woocommerce' ); ?>"><i class="fa fa-facebook"></i></a>
            <?php endif; ?>
            <?php if($woo_twitter) : ?>
                <a href="//twitter.com/share?url=<?php echo  esc_url( get_permalink() ); ?>" target="_blank" title="<?php esc_html_e( 'Share on Twitter', 'woocommerce' ); ?>"><i class="fa fa-twitter"></i></a>
            <?php endif; ?>
            <?php if($woo_pinterest) : ?>
                <a href="//pinterest.com/pin/create/button/?url=<?php echo  esc_url( get_permalink() ); ?>&amp;media=<?php echo esc_url( $product_image[0] ); ?>&amp;description=<?php echo urlencode( get_the_title() ); ?>" target="_blank" title="<?php esc_html_e( 'Pin in Pinterest', 'woocommerce' ); ?>"><i class="fa fa-pinterest"></i></a>
            <?php endif; ?>
            <?php if($woo_google): ?>
                <a href="//plus.google.com/share?url=<?php echo  esc_url( get_permalink() ); ?>" class="googleplus" title="<?php echo esc_html__('google +', 'boal'); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                    <i class="fa fa-google-plus"></i>
                </a>
            <?php endif; ?>
            <?php if($woo_linkedin) : ?>
                <a href="//www.linkedin.com/shareArticle?mini=true&url=<?php echo  esc_url( get_permalink() ); ?>&title=<?php echo esc_html__('pinterest', 'boal'); ?>&summary=<?php echo get_the_title(); ?>&source=<?php echo get_the_title(); ?>">
                    <i class="fa fa-linkedin"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
