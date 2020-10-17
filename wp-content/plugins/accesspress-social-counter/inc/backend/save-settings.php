<?php
defined('ABSPATH') or die("No script kiddies please!");

foreach($_POST as $key=>$val)
{
    $$key = $val;
}
$apsc_settings = array();//array for saving all the settings
$apsc_settings['social_profile'] = $social_profile;
$apsc_settings['profile_order'] = $profile_order;
$apsc_settings['cache_period'] = $cache_period;
$apsc_settings['font_awesome_version'] = $font_awesome_version;
$apsc_settings['social_profile_theme'] = $social_profile_theme;
$apsc_settings['counter_format'] = $counter_format;
$apsc_settings['disable_font_css'] = isset($disable_font_css)?1:0;
$apsc_settings['disable_frontend_css'] = isset($disable_frontend_css)?1:0;
update_option('apsc_settings', $apsc_settings);
wp_redirect(admin_url().'admin.php?page=ap-social-counter&message=1');
