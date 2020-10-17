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

    <article <?php post_class('post-item post-tran  clearfix '); ?>>
        <div class="article-image ">
                <?php if(has_post_thumbnail()) : ?>
                    <?php if(!get_theme_mod('sp_post_thumb')) :
                        $bg_image= get_the_post_thumbnail_url( null, 'full-thumb' );
                        $background_image="background-image:url('$bg_image')";
                        $style_css      ='style = '.$background_image.'';
                        ?>
                        <div class="post-image single-bgr-image bgr-image" data-src="<?php echo esc_attr($thumbnail_src[0]);?>" >
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
                                        <?php
                                        if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) && !get_the_title()) {
                                            $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

                                            if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
                                                $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
                                            }

                                            $time_string = sprintf( $time_string,
                                                esc_attr( get_the_date( 'c' ) ),
                                                get_the_date(),
                                                esc_attr( get_the_modified_date( 'c' ) ),
                                                get_the_modified_date()
                                            );

                                            printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark"><i class="icon icon-clock"></i> %3$s</a></span>',
                                                _x( 'Posted on', 'Used before publish date.', 'boal' ),
                                                esc_url( get_permalink() ),
                                                $time_string
                                            );
                                        }
                                        ?>
                                    </div>
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