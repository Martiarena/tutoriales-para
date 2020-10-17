<?php defined( 'ABSPATH' ) or die( "No script kiddies please!" ); ?>
<a  class="apsc-twitter-icon clearfix"  href="<?php echo 'https://twitter.com/' . esc_attr($apsc_settings[ 'social_profile' ][ 'twitter' ][ 'username' ]); ?>" target="_blank"  <?php do_action( 'apsc_twitter_link' ); ?>>
   <div class="apsc-inner-block">
        <span class="social-icon"><i class="<?php echo esc_attr($twitter);?> apsc-twitter"></i><span class="media-name">Twitter</span></span>
        <span class="apsc-count"><?php echo esc_attr($count); ?></span><span class="apsc-media-type">Followers</span>
   </div>
</a>
