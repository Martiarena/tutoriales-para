<?php
//////////////////////////////////////////////////////////////////
// Customizer - Add CSS
//////////////////////////////////////////////////////////////////
/**
 * Enqueues front-end CSS for the page Font.
 *
 * @since nanoagency
 *
 * @see wp_add_inline_style()
 */
add_action( 'wp_enqueue_scripts', 'boal_font_google');
function boal_font_google()
{
    $font_family = get_theme_mod('boal_body_font_google', 'Poppins');
    if ($font_family != 'Poppins') {
        $query_args = array(
            'family' => urlencode($font_family),
            'subset' => urlencode('latin,latin-ext'),
        );
        $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
        $boal_google_font = esc_url_raw($fonts_url);
        wp_enqueue_style('boal-fonts-customize', $boal_google_font, array(), null);
    }
}

function boal_body_font_family() {
    $default_font         = 'Poppins';
    $font_family   = get_theme_mod('boal_body_font_google',$default_font);

    // Don't do anything if the current color is the default.
    if ( $font_family === $default_font ) {
        return;
    }

    $css = '
		/* Custom  Font size */
		body {
            font-family: %1$s;
		}
	';

    wp_add_inline_style( 'boal-css', sprintf( $css, $font_family ) );
}
add_action( 'wp_enqueue_scripts', 'boal_body_font_family', 11 );

function boal_body_font_size() {
    $default_font         = '14';
    $boal_body_font_size   = get_theme_mod('boal_body_font_size',$default_font);
    // Don't do anything if the current color is the default.
    if ( $boal_body_font_size === $default_font ) {
        return;
    }

    $css = '
		/* Custom  Font size */
		body ,.entry-content {
            font-size: %1$spx;
		}
	';

    wp_add_inline_style( 'boal-css', sprintf( $css, $boal_body_font_size ) );
}
add_action( 'wp_enqueue_scripts', 'boal_body_font_size', 12 );

function boal_menu_font_size() {
    $default_font         = '14';
    $boal_menu_font_size   = get_theme_mod('boal_menu_font_size',$default_font);
    // Don't do anything if the current color is the default.
    if ( $boal_menu_font_size === $default_font ) {
        return;
    }

    $css = '
		/* Custom  Font size */
		#na-menu-primary .na-menu > li a {
            font-size: %1$spx;
		}
	';

    wp_add_inline_style( 'boal-css', sprintf( $css, $boal_menu_font_size ) );
}
add_action( 'wp_enqueue_scripts', 'boal_menu_font_size', 13 );

function boal_color_footer() {
    $default         = '';
    $boal_color_footer       = get_theme_mod('boal_color_footer',$default);

    // Don't do anything if the current color is the default.
    if ( $boal_color_footer === $default ) {
        return;
    }

    $css = '
		/* Custom  color title  */
        #na-footer .widgettitle,#na-footer ul li,#na-footer ul li a,#na-footer ul li b,[class*="ion-social-"],#na-footer,#na-footer .footer-bottom .coppy-right a
		{
		    color:%1$s;
		}
		[class*="ion-social-"]{
		    border-color:%1$s;
		}

	';

    wp_add_inline_style( 'boal-css', sprintf( $css, $boal_color_footer ) );
}
add_action( 'wp_enqueue_scripts', 'boal_color_footer', 23 );

function boal_bg_footer() {
    $default         = '';
    $boal_bg_footer       = get_theme_mod('boal_bg_footer',$default);

    // Don't do anything if the current color is the default.
    if ( $boal_bg_footer === $default ) {
        return;
    }

    $css = '
		/* Custom  color title  */
        #na-footer,#na-footer .footer-bottom,#na-footer .footer-center
		{
		    background:%1$s;
		}

	';

    wp_add_inline_style( 'boal-css', sprintf( $css, $boal_bg_footer ) );
}
add_action( 'wp_enqueue_scripts', 'boal_bg_footer', 24 );

function boal_color_topbar() {
    $default         = '';
    $boal_color_topbar       = get_theme_mod('boal_color_topbar',$default);

    // Don't do anything if the current color is the default.
    if ( $boal_color_topbar === $default ) {
        return;
    }

    $css = '
		/* Custom  color title  */
        .wrap-select-currency::after,
        .wrap-select-country::after,
        #boal-top-navbar,
        #boal-top-navbar .topbar-left a,
        #boal-top-navbar a,
        .currency_switcher .woocommerce-currency-switcher-form .dd-selected-text,
        .currency_switcher .woocommerce-currency-switcher-form .dd-option-text
		{
		    color:%1$s;
		}

	';

    wp_add_inline_style( 'boal-css', sprintf( $css, $boal_color_topbar ) );
}
add_action( 'wp_enqueue_scripts', 'boal_color_topbar', 25 );

function boal_bg_topbar() {
    $default         = '';
    $boal_bg_topbar       = get_theme_mod('boal_bg_topbar',$default);

    // Don't do anything if the current color is the default.
    if ( $boal_bg_topbar === $default ) {
        return;
    }

    $css = '
		/* Custom  color title  */
		#boal-top-navbar{
		    background:%1$s;
		}

	';

    wp_add_inline_style( 'boal-css', sprintf( $css, $boal_bg_topbar ) );
}
add_action( 'wp_enqueue_scripts', 'boal_bg_topbar', 25 );

function boal_bg_header() {
    $default         = '';
    $boal_bg_header       = get_theme_mod('boal_bg_header',$default);

    // Don't do anything if the current color is the default.
    if ( $boal_bg_header === $default ) {
        return;
    }

    $css = '
		/* Custom  color title  */
		#boal-header,.header-drawer #boal-header,.header-content-menu{
		    background:%1$s;
		}

	';

    wp_add_inline_style( 'boal-css', sprintf( $css, $boal_bg_header ) );
}
add_action( 'wp_enqueue_scripts', 'boal_bg_header', 26 );

function boal_color_menu() {
    $default         = '';
    $boal_color_menu       = get_theme_mod('boal_color_menu',$default);

    // Don't do anything if the current color is the default.
    if ( $boal_color_menu === $default ) {
        return;
    }

    $css = '
		/* Custom  color title  */
		.menu-drawer #na-menu-primary ul.mega-menu > li > a,
		#na-menu-primary ul > li[class*="-has-children"] > a::before,
		.menu-drawer #na-menu-primary ul > li[class*="-has-children"] > a::before,
		.btn-mini-search, .na-cart .icon-cart,
		.boal_icon-bar,
        #na-menu-primary ul.mega-menu > li > a
		{
		    color:%1$s;
		}

	';

    wp_add_inline_style( 'boal-css', sprintf( $css, $boal_color_menu ) );
}
add_action( 'wp_enqueue_scripts', 'boal_color_menu', 27 );


function boal_body_background() {
    $default         = '';
    $boal_bg_body       = get_theme_mod('boal_bg_body',$default);

    // Don't do anything if the current color is the default.
    if ( $boal_bg_body === $default ) {
        return;
    }

    $css = '
		/* Custom  color title  */
		body{
		    background:%1$s;
		}

	';
    wp_add_inline_style( 'boal-css', sprintf( $css, $boal_bg_body ) );
}
add_action( 'wp_enqueue_scripts', 'boal_body_background', 28 );

/**
 * Enqueues front-end CSS for the Primary  Color .
 *
 * @since boal
 *
 * @see wp_add_inline_style()
 */

function boal_primary_body() {
    $default         = '';
    $boal_primary_color       = get_theme_mod('boal_primary_body',$default);

    // Don't do anything if the current color is the default.
    if ( $boal_primary_color === $default ) {
        return;
    }

    $css = '
        .btn-outline .badge,
        .btn-inverse,
        .btn-inverse:hover, .btn-inverse:focus, .btn-inverse:active, .btn-inverse.active,
        .open .btn-inverse.dropdown-toggle,
        .btn-inverse.disabled, .btn-inverse.disabled:hover, .btn-inverse.disabled:focus, .btn-inverse.disabled:active, .btn-inverse.disabled.active, .btn-inverse[disabled], .btn-inverse[disabled]:hover, .btn-inverse[disabled]:focus, .btn-inverse[disabled]:active, .btn-inverse[disabled].active, fieldset[disabled] .btn-inverse, fieldset[disabled] .btn-inverse:hover, fieldset[disabled] .btn-inverse:focus, fieldset[disabled] .btn-inverse:active, fieldset[disabled] .btn-inverse.active,
        .btn-varian,
        .open .button.dropdown-toggle,
        .button.single_add_to_cart_button:hover, .button.single_add_to_cart_button:focus, .button.single_add_to_cart_button:active, .button.single_add_to_cart_button.active ,
        .page-content .vc_btn3.vc_btn3-style-custom ,
        .page-content .vc_btn3.vc_btn3-style-custom:hover, .page-content .vc_btn3.vc_btn3-style-custom:focus, .page-content .vc_btn3.vc_btn3-style-custom:active, .page-content .vc_btn3.vc_btn3-style-custom.active ,
        .add_to_cart_button .badge, .button.product_type_simple .badge ,
        .added_to_cart .badge,
        #loadmore-button:hover,
        .yith-wcwl-wishlistexistsbrowse a:after ,
        .quick-view a ,
        .btn-checkout ,
        .btn-order,
        .slick-prev:hover,
        .slick-next:hover,
        .na-cart .icon-cart .mini-cart-items,
        #cart-panel-loader > *:before,
        #calendar_wrap #today ,
        .expand-icon:hover::after, .expand-icon:hover::before,
        .boal_icon:hover .boal_icon-bar,
        .scrollup:hover,
        .product-image.loading::before,
        .widget_layered_nav ul li.chosen > a:before, .widget_layered_nav_filters ul li.chosen > a:before,
        .widget_layered_nav ul li a:hover:before, .widget_layered_nav_filters ul li a:hover:before,
        .onsale,
        .list-view .add_to_cart_button,
        .list-view .add_to_cart_button:hover, .list-view .add_to_cart_button:focus,
        .product-detail-wrap .product-nav .fa:hover,
        .variations_form.cart .att_label:hover, .variations_form.cart .att_label.selected,
        .blog-recent-post .na-grid .bg_gradients > a ,
        .box-list .link-more a:hover,
        .post-format .ti-control-play:hover, .post-format .ti-camera:hover, .post-format .ti-headphone:hover, .post-format .ti-quote-left:hover,
        .tags a:hover,
        div.affect-border:before, div.affect-border:after,
        div.affect-border-inner:before,
        div.affect-border-inner:after,
        .nano > .nano-pane > .nano-slider,
        .btn-primary,.btn-primary:hover,
        .entry_pagination .page-numbers:hover i,.post-tran .post-cat a,.post-cat a:before,
        .btn-variant:hover, .btn-variant:focus, .btn-variant:active, .btn-variant.active,
        .btn-read:hover,
        .box-videos .video-horizontal .slick-prev,
        .box-videos .video-horizontal .slick-next,
        .post-cat a,
        .newsletters .btn-newsletter:hover,
        .widgettitle::after,
        .box-title::after,
        .sidebar .widget_tabs_post .widget-title li.active a:after,
        button, html input[type="button"], input[type="reset"], input[type="submit"],
        input[type="submit"]:hover, input[type="submit"]:focus, input[type="submit"]:active
        {
            background-color: %1$s;
        }

        .link:hover,
        a:hover, a:focus,
        .tags-list a:hover, .tagcloud a:hover,
        .btn-outline,
        .btn-outline:hover, .btn-outline:focus, .btn-outline:active, .btn-outline.active,
        .open .btn-outline.dropdown-toggle,
        .btn-inverse .badge,
        .btn-variant .badge,
        .add_to_cart_button, .button.product_type_simple,
        .add_to_cart_button:hover, .add_to_cart_button:focus, .add_to_cart_button:active, .add_to_cart_button.active, .button.product_type_simple:hover, .button.product_type_simple:focus, .button.product_type_simple:active, .button.product_type_simple.active,
        .open .add_to_cart_button.dropdown-toggle, .open .button.product_type_simple.dropdown-toggle,
        .added_to_cart,
        .added_to_cart:hover, .added_to_cart:focus, .added_to_cart:active, .added_to_cart.active,
        .open .added_to_cart.dropdown-toggle,
        .nav-tabs > li.active > a ,
        .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus,
        .na-filter-wrap #na-filter .widget .na-ajax-load a:hover ,
        .na-filter-wrap .chosen,
        .na-filter-wrap .na-remove-attribute,
        .btn-mini-search:hover,
        #na-menu-primary ul.mega-menu > li > a:hover, #na-menu-primary ul.mega-menu > li > a:focus,
        #na-menu-primary ul.mega-menu > li[class*="mega-current-"] > a,
        #na-menu-primary ul.mega-menu > li[class*="mega-current-"] > a:before,
        #na-menu-primary ul > li:hover[class*="-has-children"] > a:before ,
        #na-menu-primary ul > li > a:hover, #na-menu-primary ul > li > a:focus,
        #na-menu-primary ul > li > ul li[class*="-has-children"]:hover:after,
        #na-menu-primary .product-details a:hover ,
        #na-top-navbar #language-switch ul > li span:hover,
        .currency_switcher .woocommerce-currency-switcher-form .dd-selected-text:hover, .currency_switcher .woocommerce-currency-switcher-form .dd-option-text:hover,
        #cart-panel-loader > *:before,
        .cart-header .close:hover ,
        .woocommerce-tabs li.resp-tab-item.active,
        .woocommerce-tabs li.resp-tab-item.active a ,
        .woocommerce-tabs .resp-tabs-list li a:hover,
        .alert a,
        .share-links .count-share:hover ,
        .share-links .count-share i,
        #sb_instagram #sbi_load .fa, #sb_instagram .sbi_follow_btn .fa,
        .menu-drawer #na-menu-primary ul.mega-menu > li > a:hover,
        .menu-vertical #na-menu-primary ul.mega-menu > li > a:hover,
        .sidebar a:hover,
        .sidebar ul li.current-cat > a,
        .sidebar #recentcomments li > a,
        #na-footer .footer-bottom .coppy-right a:hover ,
        .page-cart .product-name a,
        .contact .fa,
        .woocommerce-thankyou-order-received:before,
        .woocommerce #content table.wishlist_table.cart a.remove:hover,
        #boal-quickview .price,
        .product-image.loading::after,
        .product-image.loading::before ,
        .is-active > a,
        #boal-top-navbar a:hover, #boal-top-navbar a:focus ,
        #boal-top-navbar .topbar-left a:hover,
        #na-footer ul li a:hover ,
        .widget_layered_nav ul li.chosen, .widget_layered_nav_filters ul li.chosen,
        .widget_layered_nav ul li.chosen > a, .widget_layered_nav_filters ul li.chosen > a,
        .widget_layered_nav ul li:hover .count, .widget_layered_nav_filters ul li:hover .count ,
        .widget.recent_blog .entry-title a:hover,
        .name a:hover ,
        .price,
        .price ins,
        .list-view .price,
        .product-detail-wrap .price,
        .product-detail-wrap .product_meta > * span:hover, .product-detail-wrap .product_meta > * a:hover,
        .cart .quantity .input-group-addon:hover ,
        .woocommerce-tabs #reviews .bypostauthor .comment-text .meta > strong,
        .sidebar .widget_tabs_post .widget-title li.active a,
        .sidebar .widget_tabs_post .widget-title li a:hover, .sidebar .widget_tabs_post .widget-title li a:focus, .sidebar .widget_tabs_post .widget-title li a:active ,
        .widget.about .boal-social-icon a:hover,
        .widget-product .group-title .link-cat:hover,
        .post-list .entry-header .posted-on a:hover,
        .post-list .author strong:hover,
        .box-list .name-category,
        .box-list .name-category > a,
        .post-cat ,
        .entry-title > a:hover,
        .entry-avatar .author-title,
        .entry-avatar .author-link,
        .post-comment .fa,
        #comments .text-user > a,
        .post-related .author-link:hover,
        .item-related .post-title > a:hover ,
        .entry_pagination .pagination .fa,
        .entry_pagination .pagination .page-numbers:hover .fa ,
        .entry_pagination .page-numbers i,
        .entry_pagination .page-numbers:hover ,
        .entry_pagination .page-numbers .btn-prev,
        .entry_pagination .page-numbers .btn-next,
        .entry-content a,
        .pagination .current,.post-list .article-meta a:hover,.pagination .nav-links a:hover,
        .newsletters .btn-newsletter,
        .post-grid .article-meta a:hover,
        .wrapper-filter li.active .cat-item,
        .article-meta a:hover,
        #na-menu-primary ul > li.current-menu-item > a,
        .post-tran .entry-title a:hover,
        #na-menu-primary ul > li.current-menu-item[class*="-has-children"] > a:before,
        .posted-on:hover i,
        #na-menu-primary ul > li.current-menu-item:hover > a, #na-menu-primary ul > li.current-menu-item:focus > a,
        .video-trans .entry-title a:hover,
        .button:hover, .button:focus, .button:active, .button.active,
        .sidebar .widget_tabs_post .widget-title li.active a:hover, .sidebar .widget_tabs_post .widget-title li.active a:focus, .sidebar .widget_tabs_post .widget-title li.active a:active,
        .byline:hover i
        {
          color: %1$s;
        }

       .btn-outline,
        .btn-outline:hover, .btn-outline:focus, .btn-outline:active, .btn-outline.active,
        .open .btn-outline.dropdown-toggle,
        .btn-outline.disabled, .btn-outline.disabled:hover, .btn-outline.disabled:focus, .btn-outline.disabled:active, .btn-outline.disabled.active, .btn-outline[disabled], .btn-outline[disabled]:hover, .btn-outline[disabled]:focus, .btn-outline[disabled]:active, .btn-outline[disabled].active, fieldset[disabled] .btn-outline, fieldset[disabled] .btn-outline:hover, fieldset[disabled] .btn-outline:focus, fieldset[disabled] .btn-outline:active, fieldset[disabled] .btn-outline.active,
        .btn-inverse,
        .btn-inverse:hover, .btn-inverse:focus, .btn-inverse:active, .btn-inverse.active,
        .open .btn-inverse.dropdown-toggle,.button.active ,
        .open .button.dropdown-toggle,
        .form-control:focus,
        .searchform .form-control:focus, .woocommerce-product-search .form-control:focus,
        .page-links span.page-numbers:hover ,
        .list-view .add_to_cart_button,
        .list-view .add_to_cart_button:hover, .list-view .add_to_cart_button:focus,
        #loadmore-button:hover,
        .button.single_add_to_cart_button:hover, .button.single_add_to_cart_button:focus, .button.single_add_to_cart_button:active, .button.single_add_to_cart_button.active,
        .page-content .vc_btn3.vc_btn3-style-custom,
        .page-content .vc_btn3.vc_btn3-style-custom:hover, .page-content .vc_btn3.vc_btn3-style-custom:focus, .page-content .vc_btn3.vc_btn3-style-custom:active, .page-content .vc_btn3.vc_btn3-style-custom.active,
        .btn-checkout ,
        .btn-order,
        .woocommerce-tabs li.resp-tab-item.active,
        .product-block.border:hover ,
        .variations_form.cart .att_img:hover > img, .variations_form.cart .att_img.selected > img,
        .post-format .ti-control-play:hover, .post-format .ti-camera:hover, .post-format .ti-headphone:hover, .post-format .ti-quote-left:hover,
        blockquote,.btn-primary,
        .btn-variant:hover, .btn-variant:focus, .btn-variant:active, .btn-variant.active,
        .btn-read:hover,
         .newsletters .btn-newsletter:hover,.button.active,
         input[type="submit"], input[type="submit"]:hover
        {
          border-color: %1$s;
        }
        .post-tran .post-cat a:hover{
            color:white;
        }

	';

    wp_add_inline_style( 'boal-css', sprintf( $css, $boal_primary_color ) );
}
add_action( 'wp_enqueue_scripts', 'boal_primary_body', 29 );
?>