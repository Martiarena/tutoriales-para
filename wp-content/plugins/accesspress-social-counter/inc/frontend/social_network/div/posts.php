<?php defined( 'ABSPATH' ) or die( "No script kiddies please!" ); ?>

<a class="apsc-edit-icon clearfix" href="javascript:void(0);" <?php do_action( 'apsc_posts_link' ); ?>>
   <div class="apsc-inner-block">
        <span class="social-icon"><i class="apsc-posts <?php echo esc_attr($edit);?>"></i><span class="media-name">Post</span></span>
        <span class="apsc-count"><?php echo esc_attr($count); ?></span><span class="apsc-media-type">Post</span>
   </div>
</a>
