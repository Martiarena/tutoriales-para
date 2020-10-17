<?php
/**
 * The default template for displaying content
 *
 * @author      Nanoboal
 * @link        http://nanoboal.co
 * @copyright   Copyright (c) 2015 Nanoboal
 * @license     GPL v2
 */

$keepMenu           = str_replace('','',boal_keep_menu() );

?>
<header id="masthead" class="site-header header-simple">
    <div id="boal-header">
        <div class="<?php echo esc_attr($keepMenu);?>">
            <div class="container">
            <div class="boal-header-content">
                <!--Logo-->
                <div class="header-content-logo">
                    <?php
                            get_template_part('templates/logo');
                    ?>
                </div>
                <!-- Menu-->
                <div class="header-content-menu">
                    <div id="na-menu-primary" class="nav-menu clearfix">
                        <nav class="text-center na-menu-primary clearfix">
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
                <!--Seacrch & Cart-->
                <div class="header-content-right">
                    <div class="searchform-mini">
                        <button class="btn-mini-search"><i class="ti-search"></i></button>
                    </div>
                    <div class="searchform-wrap search-transition-wrap boal-hidden">
                        <div class="search-transition-inner">
                            <?php
                                get_search_form();
                            ?>
                            <button class="btn-mini-close pull-right"><i class="fa fa-close"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .container -->
        </div>
    </div>
</header><!-- .site-header -->