<?php defined( 'ABSPATH' ) or die( "No script kiddies please!" ); ?>

<a class="apsc-comment-icon clearfix" href="javascript:void(0);" <?php do_action( 'apsc_comments_link' ); ?>>
   <div class="apsc-inner-block">
        <span class="social-icon"><i class="apsc-comments <?php echo esc_attr($comments);?>"></i><span class="media-name">Comment</span></span>
        <span class="apsc-count"><?php echo esc_attr($count); ?></span><span class="apsc-media-type">Comments</span>
   </div>
</a>
