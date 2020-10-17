<?php

$keepMenu           = str_replace('','',boal_keep_menu() );
$menu_topbar        = str_replace('','',boal_menu_topbar() );

?>
<div id="header-placeholder" class="header-placeholder <?php echo esc_attr($keepMenu);?>"></div>
<header id="masthead" class="site-header header-drawer  <?php echo esc_attr($keepMenu);?>  <?php echo esc_attr($menu_topbar); ?>">
    <div id="boal-header">
        <div class="container-full">
            <div class="boal-header-content">
                <!--Logo-->
                <div class="header-content-logo">
                     <span class="boal_icon">
                        <span class="boal_icon-bar"></span>
                        <span class="boal_icon-bar"></span>
                        <span class="boal_icon-bar"></span>
                    </span>
                    <?php
                            get_template_part('templates/logo');
                    ?>
                </div>
                <!-- Menu-->
                <div class="header-content-menu">

                    <div class="search-menu">
                        <?php
                        if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
                            get_product_search_form();
                        }
                        else
                            get_search_form();
                        ?>

                    </div>
                </div>
                <!--Seacrch & Cart-->
                <div class="header-content-right">
                    <div class="user-login clearfix">

                        <?php if (!is_user_logged_in()) { ?>
                            <?php $current_user = wp_get_current_user(); ?>
                            <div class="author-img avatar">
                                <?php echo get_avatar( $current_user->user_email,32); ?>
                            </div>
                            <span class="hidden-xs hidden"><?php esc_html_e('Hi ! ', 'boal'); ?><a
                                    href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>"><?php echo esc_html__('Guest', 'boal'); ?></a> !</span>
                        <?php } else { ?>
                            <?php $current_user = wp_get_current_user(); ?>
                            <div class="author-img avatar">
                                <?php echo get_avatar( $current_user->user_email,32); ?>
                            </div>
                            <span class="hidden-xs hidden"><?php esc_html_e('Hi ! ', 'boal'); ?><a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>"><?php echo esc_attr($current_user->display_name); ?></a></span>
                        <?php } ?>
                        <ul class="nav navbar-nav" id="menu-topbar-menu">
                            <?php if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) { ?>
                                <li>
                                    <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
                                        <span><?php esc_html_e('My Account', 'boal'); ?></span>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if (class_exists('YITH_WCWL_UI')) {
                                $wishlist_url = str_replace('view/', '', YITH_WCWL()->get_wishlist_url());
                                ?>
                                <li>
                                    <a href="<?php echo esc_url($wishlist_url); ?>">
                                        <span><?php esc_html_e("My Wishlist", 'boal'); ?></span>
                                    </a>
                                </li>
                            <?php } ?>

                            <?php if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) { ?>
                                <li>
                                    <a href="<?php echo esc_url( wc_get_checkout_url()); ?>">
                                        <span><?php esc_html_e('Checkout', 'boal'); ?></span>
                                    </a>
                                </li>
                            <?php } ?>

                            <li>
                                <?php if (!is_user_logged_in()) { ?>
                                    <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>">
                                        <span><?php esc_html_e(' Login', 'boal'); ?></span>
                                    </a>
                                <?php } else { ?>
                                    <a href="<?php echo wp_logout_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>">
                                        <span><?php esc_html_e(' Logout', 'boal'); ?></span>
                                    </a>
                                <?php } ?>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div><!-- .container -->
    </div>
</header><!-- .site-header -->
<div class="menu-drawer">
    <div id="na-menu-primary" class="nav-menu clearfix">
        <nav class="text-left na-menu-primary clearfix">
            <?php
            if (has_nav_menu('primary_navigation')) :
                // Main Menu
                wp_nav_menu( array(
                    'theme_location' => 'primary_navigation',
                    'menu_class'     => 'nav navbar-nav na-menu mega-menu',
                    'container'      => '',
                ) );
            endif;
            ?>
        </nav>
    </div>
</div>