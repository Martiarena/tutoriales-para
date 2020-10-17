<?php
/**
 * @package     boal
 * @version     1.0
 * @author      Nanoagency
 * @link        http://www.nanoagency.co
 * @copyright   Copyright (c) 2016 Nanoagency
 * @license     GPL v2
 */

/* WooCommerce - Disable the default stylesheet WooCommerce ========================================================= */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// WooCommerce - Product Meta ==========================================================================================
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 51);

// WooCommerce - remove add_to_cart from link_close ====================================================================
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
add_action('woocommerce_add_to_cart_item', 'woocommerce_template_loop_add_to_cart', 10);

// WooCommerce - remove Star ===========================================================================================
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

// WooCommerce - cross_sell_display ====================================================================================
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woo_cart_collaterals', 'woocommerce_cross_sell_display' );


// WooCommerce - Output the WooCommerce Breadcrumb =====================================================================
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
function boal_woocommerce_breadcrumb( $args = array() ) {
    $args = wp_parse_args( $args, apply_filters( 'woocommerce_breadcrumb_defaults', array(
        'delimiter'   => '',
        'wrap_before' => '<div class = "breadcrumb"'.'>'.'<div class = "container"' .'>'. '<nav class="woocommerce-breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>',
        'wrap_after'  => '</nav></div></div>',
        'before'      => '',
        'after'       => '',
        'home'        => _x( 'Home', 'breadcrumb', 'boal' )
    ) ) );

    $breadcrumbs = new WC_Breadcrumb();

    if ( $args['home'] ) {
        $breadcrumbs->add_crumb( $args['home'], apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) );
    }

    $args['breadcrumb'] = $breadcrumbs->generate();

    wc_get_template( 'global/breadcrumb.php', $args );
}

// WooCommerce -Sidebar Detail==========================================================================================
add_action( 'woo-sidebar-detail-left', 'boal_woo_sidebar_left' );
function boal_woo_sidebar_left() {
    $woo_sidebar=get_theme_mod( 'boal_sidebar_woo_single', 'full' );
    if ( $woo_sidebar && $woo_sidebar == 'left') { ?>
        <div id="archive-sidebar" class="sidebar sidebar-left hidden-sx hidden-sm col-sx-12 col-sm-12 col-md-4 col-lg-4 detail-sidebar">
            <?php get_sidebar('shop'); ?>
        </div>
    <?php }
}

add_action( 'woo-sidebar-detail-right', 'boal_woo_sidebar_right' );
function boal_woo_sidebar_right() {
    $woo_sidebar=get_theme_mod( 'boal_sidebar_woo_single', 'full' );
    if ( $woo_sidebar && $woo_sidebar == 'right') {?>
        <div id="archive-sidebar" class="sidebar sidebar-right hidden-sx hidden-sm col-sx-12 col-sm-12 col-md-4 col-lg-4 detail-sidebar">
            <?php get_sidebar('shop'); ?>
        </div>
    <?php }
}

//content
add_action( 'woo-content-detail-before', 'boal_woo_content_before' );
function boal_woo_content_before() {
    $woo_sidebar=get_theme_mod( 'boal_sidebar_woo_single', 'full' );
    if ( $woo_sidebar && $woo_sidebar == 'full') {?>
        <div class="main-content col-sx-12 col-sm-12 col-md-12 col-lg-12">
    <?php }
    else{?>
        <div class="main-content col-sx-12 col-sm-12 col-md-8  col-lg-8 padding-content-<?php echo esc_attr($woo_sidebar)?>">
    <?php }
}
add_action( 'woo-content-detail-after', 'boal_woo_content_after' );
function boal_woo_content_after() {
    $woo_sidebar=get_theme_mod( 'boal_sidebar_woo_single', 'full' );
    if ( $woo_sidebar){?>
        </div>
    <?php }
}
// WooCommerce -Sidebar Categories =====================================================================================
add_action( 'woo-sidebar-left', 'boal_woo_sidebar_cat_left' );
function boal_woo_sidebar_cat_left() {
    $woo_sidebar=get_theme_mod( 'boal_sidebar_woo', 'left' );
    if ( $woo_sidebar && $woo_sidebar == 'left') { ?>
        <div id="archive-sidebar" class="sidebar sidebar-left hidden-sx hidden-sm col-sx-12 col-sm-12 col-md-4 col-lg-4 archive-sidebar">
            <?php get_sidebar('shop'); ?>
        </div>
    <?php }
}

add_action( 'woo-sidebar-right', 'boal_woo_sidebar_cat_right' );
function boal_woo_sidebar_cat_right() {
    $woo_sidebar=get_theme_mod( 'boal_sidebar_woo', 'left' );
    if ( $woo_sidebar && $woo_sidebar == 'right') {?>
        <div id="archive-sidebar" class="sidebar sidebar-right hidden-sx hidden-sm col-sx-12 col-sm-12 col-md-4 col-lg-4 archive-sidebar">
            <?php get_sidebar('shop'); ?>
        </div>
    <?php }
}

//content
add_action( 'woo-content-before', 'boal_woo_content_cat_before' );
function boal_woo_content_cat_before() {
    $woo_sidebar=get_theme_mod( 'boal_sidebar_woo', 'left' );
    if ( $woo_sidebar && $woo_sidebar == 'full') {?>
        <div class="main-content col-sx-12 col-sm-12 col-md-12 col-lg-12">
    <?php }
    else{?>
        <div class="main-content col-sx-12 col-sm-12 col-md-8  col-lg-8 padding-content-<?php echo esc_attr($woo_sidebar)?>">
    <?php }
}
add_action( 'woo-content-after', 'boal_woo_content_cat_after' );
function boal_woo_content_cat_after() {
    $woo_sidebar=get_theme_mod( 'boal_sidebar_woo', 'left' );
    if ( $woo_sidebar){?>
        </div>
    <?php }
}

// WooCommerce - Next / Prev nav on Product Pages ======================================================================
function boal_next_post_link_product()
{
    global $post;
    $next_post = get_next_post(true, '', 'product_cat');
    if (is_a($next_post, 'WP_Post')) { ?>
        <div class="nav-product">
            <a title="<?php esc_html_e('prev','boal')?>" href="<?php echo get_the_permalink($next_post->ID); ?>" class="fa fa-angle-left"></a>
        </div>
    <?php }
}
function boal_previous_post_link_product()
{
    global $post;
    $prev_post = get_previous_post(true, '', 'product_cat');
    if (is_a($prev_post, 'WP_Post')) { ?>
        <div class="nav-product">
            <a title="<?php esc_html_e('next','boal')?>" href="<?php echo get_the_permalink($prev_post->ID); ?>" class="fa fa-angle-right"></a>
        </div>
    <?php }
}
/* WooCommerce - Products per page ================================================================================== */
function boal_get_products_per_page(){
    global $woocommerce;
    $boal_woo_product_per_page  = get_theme_mod('boal_woo_product_per_page','');
    $default = $boal_woo_product_per_page;
    $count = $default;
    return $count;
}
add_filter('loop_shop_per_page','boal_get_products_per_page');

// WooCommerce - YITH WCWL Wishlist ====================================================================================
add_action( 'boal_yith_wishlist', 'boal_wishlist_button');
if (!function_exists('boal_wishlist_button')){
    function boal_wishlist_button() {?>
        <div class="wishlist-buttom">
            <?php if(is_plugin_active('yith-woocommerce-wishlist/init.php')) { ?>
                  <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
            <?php }?>
        </div>
    <?php
    }
}

// Product tabs: Change "Reviews" tab title ============================================================================
add_filter( 'woocommerce_product_reviews_tab_title', 'boal_woocommerce_reviews_tab_title' );
function boal_woocommerce_reviews_tab_title( $title ) {
    $title = strtr( $title, array(
        '(' => '<span>',
        ')' => '</span>'
    ) );

    return $title;
}

// Related Products: Change "related" ==================================================================================
add_filter( 'woocommerce_output_related_products_args', 'boal_related_products_args' );
  function boal_related_products_args( $args ) {
	$args['posts_per_page'] = 6; // 6 related products
	$args['columns'] = 4; // arranged in 4 columns
	return $args;
}
add_action( 'woocommerce_after_single_product_summary', 'boal_woocommerce_recently_viewed_products', 21 );

function boal_woocommerce_recently_viewed_products( $atts, $content = null ) {

	// Get shortcode parameters
	extract(shortcode_atts(array(
		"per_page" => '6'
	), $atts));

	// Get WooCommerce Global
	global $woocommerce;

	// Get recently viewed product cookies data
	$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
	$viewed_products = array_filter( array_map( 'absint', $viewed_products ) );

	// If no data, quit
	if ( empty( $viewed_products ) )
		return esc_html__( 'You have not viewed any product yet!', 'boal' );

	// Create the object
	ob_start();

	// Get products per page
	if( !isset( $per_page ) ? $number = 6 : $number = $per_page )

	// Create query arguments array
    $query_args = array(
    				'posts_per_page' => $number,
    				'no_found_rows'  => 1,
    				'post_status'    => 'publish',
    				'post_type'      => 'product',
    				'post__in'       => $viewed_products,
    				'orderby'        => 'rand'
    				);

	// Add meta_query to query args
	$query_args['meta_query'] = array();

    // Check products stock status
    $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();

	// Create a new query
	$query = new WP_Query($query_args);
	// If query return results
	if ( $query->have_posts() ) {?>

        <div class="widget widget-related products-block center">
            <h2 class="widgettitle"><?php esc_html_e( 'Recently viewed products', 'boal' ); ?></h2>
            <div class="related-wrapper container">
                <div class="products-block">
                    <div class="products-row na-carousel"  data-number="5">

                        <?php // Start the loop
                        while ( $query->have_posts()) {
                            $query->the_post();
                            wc_get_template_part( 'content', 'product-related' );
                        } ?>
                        <?php wp_reset_postdata()?>

                    </div>
                </div>
            </div>
        </div>

	<?php }
}

/* WooCommerce - Ajax add to cart =================================================================================== */
add_action('woocommerce_ajax_added_to_cart', 'boal_ajax_added_to_cart');
function boal_ajax_added_to_cart() {
    add_filter( 'add_to_cart_fragments', 'boal_header_add_to_cart_fragment' );
    function boal_header_add_to_cart_fragment( $fragments ) {
        ob_start();
        boal_cartbox();
        $fragments['.na-cart'] = ob_get_clean();
        return $fragments;
    }
}
if(!function_exists('boal_cartbox')){
    function boal_cartbox(){
        global $woocommerce;
        $cart_image = get_theme_mod('boal_cart_image', '');
        ?>
        <div class="na-cart">
            <div  class="mini-cart btn-header clearfix" role="contentinfo">
                <span class="icon-cart text-items">
                    <?php if($cart_image){ ?>
                        <img class="cart_image" src="<?php echo esc_url($cart_image); ?>" alt="cart-image">
                    <?php } else{?>
                        <i class="ti-shopping-cart"></i>
                    <?php }?>
                    <?php echo sprintf(_n(' <span class="mini-cart-items">%d</span> ', '<span class="mini-cart-items">%d</span>', $woocommerce->cart->cart_contents_count, 'boal'), $woocommerce->cart->cart_contents_count); ?>
                </span>
                <div class="group-mini-cart">
                    <div class="text-cart"><?php esc_html_e('My Cart','boal'); ?></div>
                    <div class="text-items">
                        <?php echo sprintf(_n(' <span class="mini-cart-items"></span> ', '', $woocommerce->cart->cart_contents_count, 'boal'), $woocommerce->cart->cart_contents_count);?> <?php echo esc_attr($woocommerce->cart->get_cart_total()); ?>
                    </div>
                </div>
            </div>
            <div class="cart-box">
                <?php woocommerce_mini_cart(); ?>
            </div>
        </div>
    <?php }
}