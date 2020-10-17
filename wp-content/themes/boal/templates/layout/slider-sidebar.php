<?php
/**
 * The default template for displaying content
 *
 * @author      NanoAgency
 * @link        http://nanoagency.co
 * @copyright   Copyright (c) 2015 NanoAgency
 * @license     GPL v2
 */

$format = get_post_format();
$add_class='';
$placeholder_image = get_template_directory_uri(). '/assets/images/layzyload-mini-list.jpg';
$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "boal-mini-list" );
?>

<article <?php post_class('post-item slider-sidebar  clearfix'); ?>>
    <div class="article-image">
            <?php if(has_post_thumbnail()) : ?>
                <?php if(!get_theme_mod('sp_post_thumb')) : ?>
                    <div class="post-image">
                        <a href=" <?php echo get_permalink() ?>">
                            <img  class="lazy" src="<?php echo esc_url($placeholder_image);?>"  data-src="<?php echo esc_attr($thumbnail_src[0]);?>" alt="post-image"/>
                        </a>
                    </div>
                <?php endif; ?>
                <?php else :
                    $add_class='full-width';
            endif; ?>
    </div>
    <div class="article-content side-item-text <?php echo esc_attr($add_class);?>">
        <div class="entry-header clearfix">
            <header class="entry-header-title">
                <h3 class="entry-title">
                    <?php the_title(); ?>
                </h3>
                <div class="article-meta clearfix">
                    <?php boal_entry_meta(); ?>
                </div>
            </header>
        </div>
    </div>
</article><!-- #post-## -->
