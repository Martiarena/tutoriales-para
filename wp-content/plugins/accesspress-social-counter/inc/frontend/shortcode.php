<?php
defined('ABSPATH') or die("No script kiddies please!");

$apsc_settings = $this->apsc_settings;
$cache_period = ($apsc_settings['cache_period'] != '') ? esc_attr($apsc_settings['cache_period']) * 60 * 60 : 24 * 60 * 60;

$apsc_settings['social_profile_theme'] = isset($atts['theme']) ? esc_attr($atts['theme']) : esc_attr($apsc_settings['social_profile_theme']);
$format = isset($apsc_settings['counter_format']) ? esc_attr($apsc_settings['counter_format']) : 'comma';
$enable_font_css = (isset($apsc_settings['disable_font_css']) && $apsc_settings['disable_font_css'] == 0) ? true : false;
if ($enable_font_css) {
    if (isset($apsc_settings['font_awesome_version'])) {
        $font_awesome_version = $apsc_settings['font_awesome_version'];
    } else {
        $font_awesome_version = '';
    }
} else {
    $font_awesome_version = '';
}
include(SC_PATH . 'inc/frontend/font-awesome-icon.php');
?>
<div class="apsc-icons-wrapper clearfix apsc-<?php echo esc_attr($apsc_settings['social_profile_theme']); ?> <?php echo esc_attr($font_awesome_version); ?>" >
    <?php
    if (isset($apsc_settings['profile_order']) && !empty($apsc_settings['profile_order'])) {
        foreach ($apsc_settings['profile_order'] as $social_profile) {
            if (isset($apsc_settings['social_profile'][$social_profile]['active']) && $apsc_settings['social_profile'][$social_profile]['active'] == 1) {
                ?>
                <div class="apsc-each-profile">
                    <?php
                    $count = $this->get_count($social_profile);
                    $count = ($count != 0) ? $this->get_formatted_count($count, $format) : $count;
                    switch ($social_profile) {
                        case 'facebook':
                            include(SC_PATH . 'inc/frontend/social_network/div/facebook.php');
                            break;
                        case 'twitter':
                            include(SC_PATH . 'inc/frontend/social_network/div/twitter.php');
                            break;
                        case 'instagram':
                            include(SC_PATH . 'inc/frontend/social_network/div/instagram.php');
                            break;
                        case 'youtube':
                            include(SC_PATH . 'inc/frontend/social_network/div/youtube.php');
                            break;
                        case 'soundcloud':
                            include(SC_PATH . 'inc/frontend/social_network/div/soundcloud.php');
                            break;
                        case 'dribbble':
                            include(SC_PATH . 'inc/frontend/social_network/div/dribbble.php');
                            break;
                        case 'posts':
                            include(SC_PATH . 'inc/frontend/social_network/div/posts.php');
                            break;
                        case 'comments':
                            include(SC_PATH . 'inc/frontend/social_network/div/comments.php');
                            break;
                        default:
                            break;
                    }
                    ?>
                </div><?php
            }
        }
    }
    ?>
</div>