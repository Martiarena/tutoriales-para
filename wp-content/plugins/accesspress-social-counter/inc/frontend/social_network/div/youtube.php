<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );

$social_profile_url = esc_url( $apsc_settings[ 'social_profile' ][ 'youtube' ][ 'channel_url' ] );

?>
<a class="apsc-youtube-icon clearfix" href="<?php echo esc_url($social_profile_url); ?>" target="_blank"  <?php do_action( 'apsc_youtube_link' ); ?>>
   <div class="apsc-inner-block">
        <span class="social-icon"><i class="apsc-youtube <?php echo esc_attr($youtube);?>"></i><span class="media-name">Youtube</span></span>
        <span class="apsc-count"><?php echo esc_attr($count); ?></span><span class="apsc-media-type">Subscriber</span>
   </div>
</a>
