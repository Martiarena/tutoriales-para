<?php
/**
 * The default template for displaying content
 *
 * @author      Nanoboal
 * @link        http://nanoboal.co
 * @copyright   Copyright (c) 2015 Nanoboal
 * @license     GPL v2
 */
$format = get_post_format();
$add_class='';
$placeholder_image = get_template_directory_uri(). '/assets/images/layzyload-mini-list.jpg';
$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "boal-blog-vertical" );
?>

    <article <?php post_class('post-item post-tran  clearfix post-vertical'); ?>>
        <div class="article-image">
                <?php if(has_post_thumbnail()) : ?>
                    <?php if(!get_theme_mod('sp_post_thumb')) : ?>
                        <div class="post-image">
                            <a href="<?php echo get_permalink() ?>">
                                <img  class="lazy" src="<?php echo esc_url($placeholder_image);?>"  data-src="<?php echo esc_attr($thumbnail_src[0]);?>" alt="post-image"/>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php else :
                    $add_class='full-width';
                endif; ?>
        </div>
        <div class="article-content <?php echo esc_attr($add_class);?>">
            <div class="entry-header clearfix">
                 <span class="post-cat"><?php echo boal_category(' '); ?></span>
                <header class="entry-header-title">
                    <?php
                        the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
                    ?>
                </header>
                <div class="article-meta clearfix">
                    <?php boal_entry_meta(); ?>
                </div>
            </div>
        </div>
    </article><!-- #post-## -->
