<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );

$username = $apsc_settings[ 'social_profile' ][ 'soundcloud' ][ 'username' ];
$social_profile_url = 'https://soundcloud.com/' . $username;
?>
<a class="apsc-soundcloud-icon clearfix" href="<?php echo esc_url($social_profile_url); ?>" target="_blank" <?php do_action( 'apsc_soundcloud_link' ); ?>>
   <div class="apsc-inner-block">
        <span class="social-icon"><i class="apsc-soundcloud <?php echo esc_attr($soundcloud);?>"></i><span class="media-name">Soundcloud</span></span>
        <span class="apsc-count"><?php echo esc_attr($count); ?></span><span class="apsc-media-type">Followers</span>
   </div>
</a>
