<?php 
defined('ABSPATH') or die("No script kiddies please!");

$apsc_settings = $this->apsc_settings;
//$this->print_array($apsc_settings);
?>
<div class="wrap">
    <div class="apsc-add-set-wrapper clearfix">
        <div class="apsc-panel">
            <div class="apsc-settings-header">
                <div class="apsc-logo">
                    <img src="<?php echo esc_attr(SC_IMAGE_DIR); ?>/logo.png" alt="<?php esc_attr_e('AccessPress Social Counter', 'accesspress-social-counter'); ?>" />
                </div>

                <div class="apsc-socials">
                    <p><?php _e('Follow us for new updates', 'accesspress-social-counter') ?></p>
                    <div class="ap-social-bttns">
                        <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FAccessPress-Themes%2F1396595907277967&amp;width&amp;layout=button&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=35&amp;appId=1411139805828592" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:20px; width:50px " allowTransparency="true"></iframe>
                        &nbsp;&nbsp;
                        <a href="https://twitter.com/apthemes" class="twitter-follow-button" data-show-count="false" data-lang="en">Follow @apthemes</a>
                        <script>!function (d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0];
                            if (!d.getElementById(id)) {
                                js = d.createElement(s);
                                js.id = id;
                                js.src = "//platform.twitter.com/widgets.js";
                                fjs.parentNode.insertBefore(js, fjs);
                            }
                        }(document, "script", "twitter-wjs");</script>
                    </div>
                </div>

                <div class="apsc-title"><?php _e('AccessPress Social Counter', 'accesspress-social-counter'); ?></div>
            </div>
            <?php if(isset($_GET['message'])){?><div class="notice notice-success is-dismissible"><p><?php echo __('Settings Saved Successfully','accesspress-social-counter');?></p></div><?php }?>
            <div class="notice notice-info is-dismissible">
                <p><?php _e('Note: Please check the System Status if your server system status meets all the requirement for the plugin before you use the plugin','accesspress-social-counter');?></p>
            </div>

            <div class="notice notice-info is-dismissible">
                <p>
                    <?php _e('If you find any unusual issues then please check by deleting cache using the "Delete Cache" button below. And if you like our plugin then please don\'t forget to give us a rating <a href="https://wordpress.org/support/view/plugin-reviews/accesspress-social-counter#postform" target="_blank"> here </a>. Its the only way to keep us motivated to make the plugin even better.','accesspress-social-counter');?>
                </p>
            </div>
            
            <div class="apsc-boards-wrapper">
                <h2 class="nav-tab-wrapper">
                    <a href="javascript:void(0)" id="social-profile-settings" class="nav-tab apsc-tabs-trigger apsc-active-tab"><?php _e('Social Profiles', 'accesspress-social-counter') ?></a>
                    <a href="javascript:void(0)" id="display-settings" class="nav-tab apsc-tabs-trigger"><?php _e('Display Settings', 'accesspress-social-counter'); ?></a>
                    <a href="javascript:void(0)" id="cache-settings" class="nav-tab apsc-tabs-trigger"><?php _e('Cache Settings', 'accesspress-social-counter'); ?></a>
                    <a href="javascript:void(0)" id="system-status" class="nav-tab apsc-tabs-trigger"><?php _e('System Status', 'accesspress-social-counter'); ?></a>
                    <a href="javascript:void(0)" id="how_to_use-settings" class="nav-tab apsc-tabs-trigger"><?php _e('How to use', 'accesspress-social-counter'); ?></a>
                    <a href="javascript:void(0)" id="about-settings" class="nav-tab apsc-tabs-trigger"><?php _e('About', 'accesspress-social-counter'); ?></a>
                </h2>
                
                <div class="metabox-holder">
                    <div id="optionsframework" class="postbox" style="float: left;">
                        <form class="apsc-settings-form" method="post" action="<?php echo esc_url(admin_url()) . 'admin-post.php' ?>">
                            <input type="hidden" name="action" value="apsc_settings_action"/>
                            <?php
                            /**
                             * Social Profiles
                             * */
                            include_once('boards/social-profiles.php');
                            ?>

                            <?php
                            /**
                             * Display Settings
                             * */
                            include_once('boards/display-settings.php');
                            ?>

                            <?php
                            /**
                             * Captcha Settings
                             * */
                            include_once('boards/cache-settings.php');
                            ?>
                            
                            <?php
                            /**
                             * System Status
                             * */
                            include_once('boards/system-status.php');
                            ?>

                            <?php
                            /**
                             * Captcha Settings
                             * */
                            include_once('boards/how-to-use.php');
                            ?>


                            <?php
                            /**
                             * About Tab
                             * */
                            include_once('boards/about.php');
                            ?>
                            <?php
                            /**
                             * Nonce field
                             * */
                            ?>
                        </form>   
                    </div><!--optionsframework-->
                </div>
            </div>
        </div>
        <!-- <div class="apsc-promoFloat">
            <img src="<?php //echo SC_IMAGE_DIR . '/promo-top.png' ?>" alt="promo-top" />
            <div class="apsc-promo-buttons">
                <a href="http://demo.accesspressthemes.com/wordpress-plugins/accesspress-social-pro"  target="_blank"><img src="<?php //echo SC_IMAGE_DIR . '/demo-btn.png' ?>" alt="demo link" /></a>
                <a href="http://codecanyon.net/item/accesspress-social-pro/10429645?ref=AccessKeys" target="_blank"><img src="<?php //echo SC_IMAGE_DIR . '/upgrade-btn.png' ?>" alt="upgrade link" /></a>
            </div>
            <img src="<?php //echo SC_IMAGE_DIR . '/promo-bottom.png' ?>" alt="promo-bottom" />
            <div class="apsc-promo-buttons">
                <a href="http://demo.accesspressthemes.com/wordpress-plugins/accesspress-social-pro"  target="_blank"><img src="<?php //echo SC_IMAGE_DIR . '/demo-btn.png' ?>" alt="demo link" /></a>
                <a href="http://codecanyon.net/item/accesspress-social-pro/10429645?ref=AccessKeys"  target="_blank"><img src="<?php // echo SC_IMAGE_DIR . '/upgrade-btn.png' ?>" alt="upgrade link" /></a>
            </div>
        </div> -->

        <div class="apsc-upgrade-wrapper">
            <a href="<?php echo esc_url(APSC_PRO_LINK); ?>" target="_blank">
                <img src="<?php echo esc_attr(SC_IMAGE_DIR) . '/upgrade-to-pro/upgrade-to-pro.png' ?>" style="width:100%;">
            </a>

            <div class="apsc-upgrade-button-wrap-backend">

                <a href="<?php echo esc_attr(APSC_PRO_DEMO); ?>" class="smls-demo-btn" target="_blank">Demo</a>

                <a href="<?php echo esc_url(APSC_PRO_LINK); ?>" target="_blank" class="smls-upgrade-btn">Upgrade</a>

                <a href="<?php echo esc_attr(APSC_PRO_DETAIL); ?>" target="_blank" class="smls-upgrade-btn">Plugin Information</a>

            </div>

            <a href="<?php echo esc_url(APSC_PRO_LINK); ?>" target="_blank">
                <img src="<?php echo esc_attr(SC_IMAGE_DIR); ?>/upgrade-to-pro/upgrade-to-pro-feature.png" alt="<?php _e( 'AccessPress Social Pro', 'accesspress-social-counter' ); ?>" style="width:100%;">
            </a>
        </div>
    </div>
</div>