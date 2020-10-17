<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );

$social_profile_url = 'https://dribbble.com/' . $apsc_settings[ 'social_profile' ][ 'dribbble' ][ 'username' ];
?>

<a class="apsc-dribble-icon clearfix" href="<?php echo esc_url($social_profile_url); ?>" target="_blank" <?php do_action( 'apsc_dribbble_link' ); ?>>
   <div class="apsc-inner-block">
        <span class="social-icon"><i class="apsc-dribbble <?php echo esc_attr($dribble);?>"></i><span class="media-name">dribble</span></span>
        <span class="apsc-count"><?php echo esc_attr($count); ?></span><span class="apsc-media-type">Followers</span>
   </div>
</a>
