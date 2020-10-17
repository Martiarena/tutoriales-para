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
$comments = get_theme_mod('boal_post_cat_meta_comment', true);
$view = get_theme_mod('boal_post_meta_view', true);
$layout = $atts['layout_types'];
?>

    <article <?php post_class('post-item   clearfix '); ?>>
        <div class="article-image post-half">
                <?php if(has_post_thumbnail()) : ?>
                    <?php if(!get_theme_mod('sp_post_thumb')) :
                        $bg_image= get_the_post_thumbnail_url( null, 'full-thumb' );
                        $background_image="background-image:url('$bg_image')";
                        ?>
                        <div class="post-image single-bgr-image"  data-src="<?php echo esc_attr($thumbnail_src[0]);?>"">
                        </div>
                        <div class="article-content">
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
                            <div class="entry-content">
                                <?php
                                if ( has_excerpt() || is_search() ){
                                    boal_excerpt();
                                }
                                else{
                                    echo boal_content(50);
                                }

                                wp_link_pages( array(
                                    'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'boal' ) . '</span>',
                                    'after'       => '</div>',
                                    'link_before' => '<span class="page-numbers">',
                                    'link_after'  => '</span>',
                                    'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'boal' ) . ' </span>%',
                                    'separator'   => '<span class="screen-reader-text">, </span>',
                                ) );
                                ?>

                            </div>
                        </div>
                    <?php endif; ?>
                <?php else :
                    $placeholder_image = get_template_directory_uri(). '/assets/images/placeholder-box.png';
                    ?>
                    <div class="post-image  placeholder-trans ">
                        <a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('buggy-blog-tran'); ?>
                            <img src="<?php echo esc_url($placeholder_image); ?>" class="wp-post-image" width="1170" height="500">
                        </a>
                    </div>
                <?php endif; ?>
        </div>
    </article>