<?php
defined('ABSPATH') or die("No script kiddies please!");

$facebook_method = ( isset($apsc_settings['social_profile']['facebook']['method']) && $apsc_settings['social_profile']['facebook']['method'] != '' ) ? esc_attr($apsc_settings['social_profile']['facebook']['method']) : '2';
if ($facebook_method == '1') {
    $facebook_page_id = isset($apsc_settings['social_profile']['facebook']['page_id']) && $apsc_settings['social_profile']['facebook']['page_id'] != '' ? esc_attr($apsc_settings['social_profile']['facebook']['page_id']) : '';
} else {
    $facebook_page_id = isset($apsc_settings['social_profile']['facebook']['fb_page_id']) && $apsc_settings['social_profile']['facebook']['fb_page_id'] != '' ? esc_attr($apsc_settings['social_profile']['facebook']['fb_page_id']) : '';
}
?>
<a  class="apsc-facebook-icon clearfix" href="<?php echo "https://facebook.com/" . $facebook_page_id; ?>" target="_blank" <?php do_action('apsc_facebook_link'); ?>>
    <div class="apsc-inner-block">
        <span class="social-icon"><i class="<?php echo esc_attr($facebook); ?> apsc-facebook"></i><span class="media-name">Facebook</span></span>
        <span class="apsc-count"><?php echo esc_attr($count); ?></span><span class="apsc-media-type">Fans</span>
    </div>
</a>
