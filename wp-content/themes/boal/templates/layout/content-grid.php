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
$placeholder_image = get_template_directory_uri(). '/assets/images/layzyload-grid.jpg';
//share
$share = get_theme_mod('boal_post_meta_share', false);
?>

<article <?php post_class('post-item post-grid disss clearfix'); ?>>
    <div class="article-tran hover-share-item">
        <?php if(has_post_thumbnail()) : ?>
            <?php if(!get_theme_mod('sp_post_thumb')) : ?>
                <?php if(has_post_thumbnail()) : ?>
                    <?php
                    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "boal-blog-grid" );
                    ?>
                    <div class="post-image">
                        <a href="<?php echo get_permalink() ?>" class="bgr-item hidden-xs"></a>
                        <a href="<?php echo get_permalink();?>">
                            <img  class="lazy" src="<?php echo esc_url($placeholder_image);?>" data-src="<?php echo esc_attr($thumbnail_src[0]);?>" alt="post-image"/>
                        </a>
                        <?php
                        if ($share) { ?>
                            <?php get_template_part('templates/share-social');
                        }
                        ?>
                        <span class="post-cat"><?php echo boal_category(' '); ?></span>
                    </div>
                <?php endif;?>
                <div class="article-content">
                    <div class="entry-header clearfix">
                        <?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
                    </div>
                    <div class="article-meta clearfix">
                        <?php boal_entry_meta(); ?>
                    </div>
                    <div class="entry-content">
                        <div>
                            <?php echo boal_content(25);?>
                        </div>
                        <a  class="btn-read" href="<?php echo get_permalink() ?>"><?php esc_html_e('Read More','boal')?></a>
                    </div>
                </div>
            <?php endif; ?>
        <?php else :
            $placeholder_image = get_template_directory_uri(). '/assets/images/layzyload-tran.jpg';
            ?>
            <div class="post-image  placeholder-trans">
                <?php
                if ($share) { ?>
                    <?php get_template_part('templates/share');
                }
                ?>
            </div>
            <div class="article-content no-thumb">
                <span class="post-cat"><?php echo boal_category(' '); ?></span>
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
                <div class="entry-content">
                    <div>
                        <?php echo boal_content(25);?>
                    </div>
                    <a  class="btn-read" href="<?php echo get_permalink() ?>"><?php esc_html_e('Read More','boal')?></a>
                </div>
            </div>
        <?php endif; ?>
    </div>

</article><!-- #post-## -->
