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
$placeholder_image = get_template_directory_uri(). '/assets/images/layzyload-sidebar.jpg';
?>

<article <?php post_class('post-item post-sidebar  clearfix'); ?>>
    <div class="article-image">
            <?php if(has_post_thumbnail()) : ?>
                <?php if(!get_theme_mod('sp_post_thumb')) : ?>
                    <?php $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "boal-sidebar" ); ?>
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
                <?php
                    the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
                ?>
            </header>
        </div>
        <div class="article-meta clearfix">
            <?php boal_entry_meta(); ?>
        </div>
    </div>
</article><!-- #post-## -->
