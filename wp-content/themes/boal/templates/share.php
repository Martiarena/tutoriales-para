<div class="entry-footer-social clearfix">
    <div class="entry-footer-left">
        <?php get_template_part('templates/tag'); ?>
    </div>
    <div class="entry-footer-right">
        <div class="social share-links clearfix">
            <?php
            $share_facebook     = get_theme_mod('boal_share_facebook',false);
            $share_twitter      = get_theme_mod('boal_share_twitter',false);
            $share_google       = get_theme_mod('boal_share_google',false);
            $share_linkedin     = get_theme_mod('boal_share_linkedin',false);
            $share_pinterest    = get_theme_mod('boal_share_pinterest',false);
            ?>
            <div class="count-share">
                <ul class="social-icons list-unstyled list-inline">
                    <?php if ($share_facebook):?>
                    <li class="social-item facebook">
                        <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" title="<?php echo esc_html__('facebook', 'boal'); ?>" class="post_share_facebook facebook" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=220,width=600');return false;">
                            <i class="fa fa-facebook"></i>
                            <?php esc_html_e('facebook', 'boal'); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if ($share_twitter):?>
                    <li class="social-item twitter">
                        <a href="https://twitter.com/share?url=<?php the_permalink(); ?>" title="<?php echo esc_html__('twitter', 'boal'); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=260,width=600');return false;" class="product_share_twitter twitter">
                            <i class="fa fa-twitter"></i>
                            <?php esc_html_e('twitter', 'boal'); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if ($share_google):?>
                    <li class="social-item google">
                        <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" class="googleplus" title="<?php echo esc_html__('google +', 'boal'); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                            <i class="fa fa-google-plus"></i>
                            <?php esc_html_e('google+', 'boal'); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if ($share_linkedin):?>
                    <li class="social-item linkedin">
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink();?>&title=<?php echo esc_html__('pinterest', 'boal'); ?>&summary=<?php echo get_the_title(); ?>&source=<?php echo get_the_title(); ?>">
                            <i class="fa fa-linkedin"></i>
                            <?php esc_html_e('pinterest', 'boal'); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if ($share_pinterest):?>
                        <li class="social-item pinterest">
                            <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php if(function_exists('the_post_thumbnail')) echo wp_get_attachment_url(get_post_thumbnail_id()); ?>&description=<?php echo get_the_title(); ?>" title="<?php echo esc_html__('pinterest', 'boal'); ?>" class="pinterest">
                                <i class="fa fa-pinterest"></i>
                                <?php esc_html_e('pinterest', 'boal'); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

