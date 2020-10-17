<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );

$username = $apsc_settings[ 'social_profile' ][ 'instagram' ][ 'username' ];
$user_id = $apsc_settings[ 'social_profile' ][ 'instagram' ][ 'user_id' ];
$social_profile_url = 'https://instagram.com/' . $username;
?>
<a  class="apsc-instagram-icon clearfix" href="<?php echo esc_url($social_profile_url); ?>" target="_blank"   <?php do_action( 'apsc_instagram_link' ); ?>>
     <div class="apsc-inner-block">
          <span class="social-icon"><i class="apsc-instagram <?php echo esc_attr($instagram);?>"></i><span class="media-name">Instagram</span></span>
          <span class="apsc-count"><?php echo esc_attr($count); ?></span><span class="apsc-media-type">Followers</span>
     </div>
</a>
